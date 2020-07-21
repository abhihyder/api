<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name'=> $this->name,
            'discription'=> $this->detail,
            'price'=> $this->price,
            'discount'=> $this->discount,
            'net_price'=> round((1 - ($this->discount/100)) * $this->price, 2),
            'stock'=> $this->stock ==0 ? 'Out of stock' : $this->stock,
            'rating'=> $this->review->count() > 0 ? round( $this->review->sum('star')/ $this->review->count(), 2): 'No rating yet',
            'href'=> [
                'review' => url('api/product/review/'. $this->id),
            ],
        ];
    }
}
