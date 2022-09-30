<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Order */
class OrderResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'statusId' => $this->status_id,
            'customerName' => $this->customer_name,
            'createdAt' => $this->created_at,
            'total' => $this->total,
        ];
    }
}
