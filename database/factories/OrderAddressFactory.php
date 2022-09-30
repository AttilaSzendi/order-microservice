<?php

namespace Database\Factories;

use App\Enums\AddressType;
use App\Models\Order;
use App\Models\OrderAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderAddressFactory extends Factory
{
    protected $model = OrderAddress::class;

    public function definition(): array
    {
        return [
            'order_id' => function(){
                return Order::factory()->create()->id;
            },
            'type_id' => AddressType::random(),
            'title' => $this->faker->word,
            'zip' => $this->faker->postcode,
            'city' => $this->faker->city,
            'address' => $this->faker->address,
        ];
    }

    public function billing(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'type_id' => AddressType::BILLING,
            ];
        });
    }

    public function shipping(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'type_id' => AddressType::SHIPPING,
            ];
        });
    }
}
