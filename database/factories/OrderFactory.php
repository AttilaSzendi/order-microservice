<?php

namespace Database\Factories;

use App\Enums\DeliveryMethod;
use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'customer_name' => $this->faker->name,
            'customer_email' => $this->faker->email,
            'delivery_method_id' => DeliveryMethod::random(),
            'status_id' => OrderStatus::random(),
        ];
    }
}
