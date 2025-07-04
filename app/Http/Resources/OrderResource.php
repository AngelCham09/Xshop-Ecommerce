<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'total_price' => $this->total_price,
            'status' => strtoupper($this->status),
            'created_at' => $this->created_at
                ->timezone('Asia/Kuala_Lumpur')
                ->format('d F Y h:i A'),
            'order_items' => OrderItemResource::collection($this->whenLoaded('order_items')),
        ];
    }
}
