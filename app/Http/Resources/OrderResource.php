<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request) {
        return [
            'id'          => $this->id,
            'created_at'  => $this->created_at->format('Y.d.m H:i'),
            'full_name'   => $this->full_name,
            'quantity'    => $this->quantity,
            'status'      => $this->status,
            'total_price' => $this->totalPrice()
        ];
    }
}
