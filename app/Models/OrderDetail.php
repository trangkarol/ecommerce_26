<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'number',
        'total_price',
    ];

    protected $appends = ['total_price_format'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getTotalPriceFormatAttribute()
    {
        return number_format($this->total_price, 3, ',', ',') . ' ' . trans('common.lbl-vnd');
    }
}
