<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Order::factory()->count(200)
            ->has(OrderItem::factory()->count(3), 'items')
            ->has(OrderAddress::factory()->shipping(), 'addresses')
            ->has(OrderAddress::factory()->billing(), 'addresses')
            ->create();
    }
}
