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
}