<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name_ar,
            'name_en' => $this->name_en,
            'desc' => $this->description_ar,
            'desc_en' => $this->description_en,
            'price' => $this->price,
            'discount_price' => $this->discount_price,
            'best_seller' => $this->best_seller,
            'review' => $this->reviews()->count(),
            'image' => asset($this->image),
            'slug' => $this->slug,
            'review_avg' => $this->review,
        ];
    }
}
