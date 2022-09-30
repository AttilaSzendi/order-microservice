<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderUpdateRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;

class OrderUpdateController extends Controller
{
    public function __invoke(OrderUpdateRequest $request, Order $order): OrderResource
    {
        $order->update($request->validated());

        return new OrderResource($order);
    }
}
