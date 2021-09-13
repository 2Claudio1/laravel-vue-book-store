<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Book extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'genre' => $this->genre,
            //'genre_name' => $this->genre->name,
            'title' => $this->title,
            'description' => $this->description,
            'cover_image' => $this->cover_img,
            'price' => $this->price,
            //'quantity' => 1
        ];
    }
}