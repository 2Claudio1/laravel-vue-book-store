<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function books()
    {
        return $this->belongsToMany('App\Models\Book')->using('App\Models\Book_Purchase')->withPivot('qty', 'unit_price');
    }
}
