<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class OrderStoreController extends Controller
{
    public function __invoke(OrderRequest $request): JsonResponse
    {
        /** @var Order $order */
        $order = Order::query()->create($request->validated());

        $order->items()->createMany($request->input('products'));

        $order->addresses()->create($request->input('billing_address'));
        $order->addresses()->create($request->input('shipping_address'));

        return response()->json(['data' => ['orderId' => $order->id]]);
    }
}
