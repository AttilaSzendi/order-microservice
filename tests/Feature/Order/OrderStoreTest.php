<?php

namespace Tests\Feature\Order;

use App\Enums\AddressType;
use App\Enums\DeliveryMethod;
use App\Enums\OrderStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class OrderStoreTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function ordersCanBeStored()
    {
        $input = [
            'customerName' => 'John Doe',
            'customerEmail' => 'johndoe@arukereso.hu',
            'deliveryMethodId' => DeliveryMethod::HOME_DELIVERY,
            'billingAddress' => [
                'type_id' => AddressType::BILLING,
                'title' => 'test billing address',
                'zip' => '1234as',
                'city' => 'test city',
                'address' => 'test address',
            ],
            'shippingAddress' => [
                'type_id' => AddressType::SHIPPING,
                'title' => 'test delivery address',
                'zip' => 'sdfg3456345',
                'city' => 'test city2',
                'address' => 'test address 2',
            ],
            'products' => [
                [
                    'name' => 'test product',
                    'quantity' => 2,
                    'grossPrice' => 1000
                ],
                [
                    'name' => 'test product 2',
                    'quantity' => 3,
                    'grossPrice' => 1500
                ]
            ]
        ];

        $response = $this->postJson(route('order-store'), $input);

        $response->assertStatus(Response::HTTP_OK);

        $orderId = 1;

        $this->assertDatabaseHas('orders', [
            'id' => $orderId,
            'customer_name' => $input['customerName'],
            'customer_email' => $input['customerEmail'],
            'delivery_method_id' => $input['deliveryMethodId'],
            'status_id' => OrderStatus::NEW,
        ]);

        $this->assertDatabaseHas('order_addresses', [
            'id' => 1,
            'order_id' => $orderId,
            'type_id' => AddressType::BILLING,
            'title' => $input['billingAddress']['title'],
            'zip' => $input['billingAddress']['zip'],
            'city' => $input['billingAddress']['city'],
            'address' => $input['billingAddress']['address'],
        ]);

        $this->assertDatabaseHas('order_addresses', [
            'id' => 2,
            'order_id' => $orderId,
            'type_id' => AddressType::SHIPPING,
            'title' => $input['shippingAddress']['title'],
            'zip' => $input['shippingAddress']['zip'],
            'city' => $input['shippingAddress']['city'],
            'address' => $input['shippingAddress']['address'],
        ]);

        $this->assertDatabaseHas('order_items', [
            'id' => 1,
            'order_id' => $orderId,
            'name' => $input['products'][0]['name'],
            'quantity' => $input['products'][0]['quantity'],
            'gross_price' => $input['products'][0]['grossPrice'],
        ]);

        $this->assertDatabaseHas('order_items', [
            'id' => 2,
            'order_id' => $orderId,
            'name' => $input['products'][1]['name'],
            'quantity' => $input['products'][1]['quantity'],
            'gross_price' => $input['products'][1]['grossPrice'],
        ]);

        $response->assertExactJson([
            'data' => [
                'orderId' => $orderId
            ]
        ]);
    }
}
