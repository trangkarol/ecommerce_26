<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'birthday',
        'avatar',
        'role',
        'phone_number',
        'address',
        'provider',
        'provider_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $appends = ['path_avatar'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function suggestProducts()
    {
        return $this->hasMany(SuggestProduct::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'ratings')->withPivot('point')->withTimestamps();
    }

    public function isAdmin()
    {
        return $this->role == config('setting.role.admin');
    }

    public function isUser()
    {
        return $this->role == config('setting.role.user');
    }

    public function getPathAvatarAttribute()
    {
        return url(config('setting.path.show'), $this->avatar);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function setBirthdayAttribute($value)
    {
        $this->attributes['birthday'] = date_create($value);
    }
}
