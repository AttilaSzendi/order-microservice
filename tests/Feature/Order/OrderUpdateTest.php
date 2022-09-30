<?php

namespace Tests\Feature\Order;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class OrderUpdateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function orderStatusesCanBeUpdated()
    {
        /** @var Order $order */
        $order = Order::factory()->create(['status_id' => OrderStatus::NEW]);

        $input = [
            'statusId' => OrderStatus::SHIPPED
        ];

        $response = $this->postJson(route('order-update', $order->id), $input);

        $response->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status_id' => $input['statusId'],
        ]);
    }
}
