<?php

namespace App\Http\Requests;

use App\Enums\DeliveryMethod;
use Illuminate\Validation\Rule;

class OrderRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'delivery_method_id' => ['required', 'numeric', Rule::in(DeliveryMethod::all())],
            'billing_address.title' => 'required|string',
            'billing_address.zip' => 'required|string',
            'billing_address.city' => 'required|string',
            'billing_address.address' => 'required|string',
            'shipping_address.title' => 'required|string',
            'shipping_address.zip' => 'required|string',
            'shipping_address.city' => 'required|string',
            'shipping_address.address' => 'required|string',
            'products.*.name' => 'required|string',
            'products.*.quantity' => 'required|numeric',
            'products.*.gross_price' => 'required|numeric',
        ];
    }
}
