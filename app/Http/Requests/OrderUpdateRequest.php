<?php

namespace App\Http\Requests;

use App\Enums\OrderStatus;
use Illuminate\Validation\Rule;

class OrderUpdateRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'status_id' => ['required', 'numeric', Rule::in(OrderStatus::all())]
        ];
    }
}
