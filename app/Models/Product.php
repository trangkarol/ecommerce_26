<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'image',
        'price',
        'number_current',
        'category_id',
        'made_in',
        'date_manufacture',
        'date_expiration',
        'avg_rating',
        'description',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $appends = ['path_image'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'ratings')->withPivot('point')->withTimestamps();
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_details')->withPivot('number', 'total_price')->withTimestamps();
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function getPathImageAttribute()
    {
        return url(config('setting.path.show'), $this->image);
    }

    public function setDateManufacturedAttribute($value)
    {
        $this->attributes['date_manufacture'] = date_create($value);
    }

    public function setDateExpirationAttribute($value)
    {
        $this->attributes['date_expiration'] = date_create($value);
    }

    public function getPriceFormatAttribute()
    {
        return number_format($this->price, 3, ',', ',') . ' ' . trans('common.lbl-vnd');
    }
}
