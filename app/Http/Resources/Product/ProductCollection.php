<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return  [
                'name'=> $this->name,
                'price'=> $this->price,
                'discount'=> $this->discount,
                'net_price'=> round((1 - ($this->discount/100)) * $this->price, 2),
                'rating'=> $this->review->count() > 0 ? round( $this->review->sum('star')/ $this->review->count(), 2): 'No rating yet',
                'href'=> [
                    'link' => url('api/product/'. $this->id),
                ],
        ];
    }
}
