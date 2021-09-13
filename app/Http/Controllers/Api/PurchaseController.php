<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Purchase as PurchaseResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Purchase;

class PurchaseController extends Controller
{
    public function purchases(Request $request)
    {
        $userType = Auth::user()->type;

        $purchases = PurchaseResource::collection(Purchase::all());

        if ($userType == 'Customer') {

            $filtered_collection = $purchases->filter(function ($item) {
                return $item->customer_id == Auth::user()->id;
            })->values();

            return $filtered_collection;
        }

        return $this->pendingPurchases($request);
    }

    public function pendingPurchases(Request $request)
    {
        $purchases = PurchaseResource::collection(Purchase::all());

        $filtered_collection = $purchases->filter(function ($item) {
            return $item->status == "P";
        })->values();

        return $filtered_collection;
    }

    public function deliverPurchase(Request $request)
    {
        $order = Purchase::find($request->id);
        $order->status='D';
        $order->save();

        return $this->pendingPurchases($request);
    }

    public function cancelPurchase(Request $request)
    {
        $order = Purchase::find($request->id);
        $order->status='C';
        $order->save();

        return $this->pendingPurchases($request);
    }

    public function store(Request $request)
    {
        $purchase = new Purchase();
        $purchase->date = date("Y-m-d");
        $purchase->status = "P";
        $purchase->customer_id = Auth::user()->id;
        $purchase->total=$request->price;
        $purchase->save();

        foreach ($request->order as $item) {
            $purchase->books()->attach($item['item']['id'], ['purchase_id' => $purchase->id, 'qty' => $item['quantity'], 'unit_price' => $item['item']['price']]);
        }

        return response()->json(new PurchaseResource($purchase), 201);
    }
}
