<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'id'            => $this->id,
            'name'          => $this->name,
            'supplier_name' => optional($this->supplier)->name,
            // 'product_image' => $this->product_image,
            'price'         => $this->price,
            'properties'    => $this->properties,

        ];

    }
}
