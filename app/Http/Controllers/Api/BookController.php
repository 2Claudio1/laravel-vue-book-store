<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index(Request $request)
    {
        
        //$books = DB::table('books')->get();
        $books = DB::table('books')
            ->leftJoin('genres', 'genres.code', '=', 'books.genre')
            ->get();
        
        return $books;
    }

    public function genresIndex(Request $request){

        $genres = DB::table('genres')->get();

        return $genres;
    }
}