<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function compras()
    {
        return $this->belongsToMany('App\Models\Purchase')->using('App\Models\Book_Purchase');
    }

    public function generos()
    {
        return $this->belongsTo(Genre::class);
    }
}