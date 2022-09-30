<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 * @property string customer_name
 * @property string customer_email
 * @property int delivery_method_id
 * @property int status_id
 * @property int total
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Collection|OrderItem[] items
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = ['customer_name', 'customer_email', 'delivery_method_id', 'status_id'];

    public function addresses(): HasMany
    {
        return $this->hasMany(OrderAddress::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getTotalAttribute(): int
    {
        $items = $this->items;

        $total = 0;

        foreach ($items as $item) {
            $total += $item->gross_price * $item->quantity;
        }

        return $total;
    }
}
