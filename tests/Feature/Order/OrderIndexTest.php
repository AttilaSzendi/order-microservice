<?php

namespace Tests\Feature\Order;

use App\Enums\AddressType;
use App\Enums\DeliveryMethod;
use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class OrderIndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function ordersCanBeListed()
    {
        Order::factory()->count($count = 2)->create();

        $response = $this->postJson(route('order-index'));

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonCount($count, 'data');

        $response->assertJsonStructure([
            'data' => [
                [
                    'id',
                    'statusId',
                    'customerName',
                    'createdAt',
                    'total',
                ]
            ]
        ]);
    }

    /** @test */
    public function ordersCanBeFilteredById()
    {
        [$order1] = Order::factory()->count($count = 2)->create();

        $response = $this->postJson(route('order-index', ['id' => $order1->id]));

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonCount(1, 'data');
    }

    /** @test */
    public function ordersCanBeFilteredByStatusId()
    {
        /** @var Order $order1 */
        $order1 = Order::factory()->create(['status_id' => OrderStatus::NEW->value]);
        Order::factory()->create(['status_id' => OrderStatus::SHIPPED->value]);

        $response = $this->postJson(route('order-index', ['statusId' => $order1->status_id]));

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonCount(1, 'data');
    }

    /** @test */
    public function ordersCanBeFilteredByDateFrom()
    {
        Order::factory()->create(['created_at' => now()->subDays(2)]);
        Order::factory()->create(['created_at' => now()->subDays(10)]);

        $response = $this->postJson(route('order-index', ['dateFrom' => now()->subDays(5)->toDateTimeString()]));

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonCount(1, 'data');
    }

    /** @test */
    public function ordersCanBeFilteredByDateUntil()
    {
        Order::factory()->create(['created_at' => now()->subDays(2)]);
        Order::factory()->create(['created_at' => now()->subDays(10)]);

        $response = $this->postJson(route('order-index', ['dateUntil' => now()->subDays(5)->toDateTimeString()]));

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonCount(1, 'data');
    }
}
