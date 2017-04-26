<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuggestProduct extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_name',
        'category_id',
        'category_name',
        'sub_category_id',
        'sub_category_name',
        'price',
        'user_id',
        'images',
        'number_current',
        'made_in',
        'date_manufacture',
        'date_expiration',
        'is_accept',
        'description',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $appends = ['path_images', 'price_format', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function setDateManufactureAttribute($value)
    // {
    //     $this->attributes['date_manufacture'] = date_create($value);
    // }

    // public function setDateExpirationAttribute($value)
    // {
    //     $this->attributes['date_expiration'] = date_create($value);
    // }

    public function getPathImagesAttribute()
    {
        return url(config('setting.path.show'), $this->images);
    }

    public function getPriceFormatAttribute()
    {
        return number_format($this->price, 3, ',', ',') . ' ' . trans('common.lbl-vnd');
    }

    public function getStatusAttribute()
    {
        if ($this->is_accept == config('setting.product_status.accpet')) {
            return trans('common.product_status.accpet');
        }

        if ($this->is_accept == config('setting.product_status.cancel')) {
            return trans('common.product_status.cancel');
        }

        return trans('common.product_status.warning');
    }
}
