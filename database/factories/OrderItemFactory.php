<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition(): array
    {
        return [
            'order_id' => function(){
                return Order::factory()->create()->id;
            },
            'name' => $this->faker->word,
            'quantity' => $this->faker->numberBetween(1, 10),
            'gross_price' => $this->faker->numberBetween(10, 200),
        ];
    }
}
