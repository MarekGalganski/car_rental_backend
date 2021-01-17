<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserBookingsResource extends JsonResource
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
            'created_at' => $this->created_at,
            'from' => $this->from,
            'to' => $this->to,
            'price' => $this->price,
            'car_brand' => $this->car->brand,
            'car_model' => $this->car->model,
        ];
    }
}
