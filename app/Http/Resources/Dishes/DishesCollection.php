<?php

namespace App\Http\Resources\Dishes;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DishesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'items' => $this->collection,
        ];
    }
}
