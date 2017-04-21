<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'total_price',
        'number',
        'status',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $appends = ['total_price_format', 'date_format'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_details')->withPivot('number', 'total_price')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDeatils()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function getTotalPriceFormatAttribute()
    {
        return number_format($this->total_price, 3, '.', ',') . ' ' . trans('common.lbl-vnd');
    }

    public function getDateFormatAttribute()
    {
        return date_format($this->created_at, 'Y/m/d');
    }
}
