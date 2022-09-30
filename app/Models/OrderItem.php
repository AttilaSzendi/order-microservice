<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string quantity
 * @property string gross_price
 */
class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'name', 'quantity', 'gross_price'];
}
