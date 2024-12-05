<?php

// app/Http/Resources/BookResource.php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'image' => $this->image,
            'book_name' => $this->book_name,
            'creator' => $this->creator,
            'price' => $this->price,
            'description' => $this->description,
            'category' => new CategoryResource($this->whenLoaded('category')), // Relasi dengan kategori
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}

