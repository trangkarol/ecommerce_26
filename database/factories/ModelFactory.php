<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->email,
        'password' => '123456',
        'avatar' => config('setting.images.avatar'),
        'birthday' => '12/12/2016',
        'address' => $faker->address,
        'phone_number' =>$faker->phoneNumber,
        'role' => $faker->numberBetween(0, 1),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Category::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'type_category' => $faker->numberBetween(0, 2),
        'parent_id' => $faker->numberBetween(1, 10),
        'image' => config('setting.images.category'),
    ];
});

$factory->define(App\Models\Product::class, function (Faker\Generator $faker) {
    static $categoryId;

    return [
        'name' => $faker->name,
        'image' => config('setting.images.product'),
        'price' => $faker->numberBetween(1000, 10000),
        'number_current' => $faker->numberBetween(10, 100),
        'category_id' => $faker->randomElement($categoryId ?: $categoryId = App\Models\Category::pluck('id')->toArray()),
        'made_in' => $faker->company,
        'date_manufacture' => $faker->dateTime($max = 'now'),
        'date_expiration' => $faker->dateTime($max = 'now'),
        'avg_rating' => $faker->numberBetween(1.5, 5),
        'description' => $faker->name,
    ];
});

$factory->define(App\Models\Order::class, function (Faker\Generator $faker) {
    static $userId;

    return [
        'user_id' => $faker->randomElement($userId ?: $userId = App\Models\User::pluck('id')->toArray()),
        'total_price' => $faker->numberBetween(100, 1000000),
        'number' => $faker->numberBetween(10, 100),
        'status' => $faker->numberBetween(0, 2),
    ];
});

$factory->define(App\Models\OrderDetail::class, function (Faker\Generator $faker) {
    static $userId;
    static $productId;

    return [
        'order_id' => $faker->randomElement($userId ?: $userId = App\Models\Order::pluck('id')->toArray()),
        'product_id' => $faker->randomElement($productId ?: $productId = App\Models\Product::pluck('id')->toArray()),
        'number' => $faker->numberBetween(10, 100),
        'total_price' => $faker->numberBetween(1000, 100000),
    ];
});

$factory->define(App\Models\Rating::class, function (Faker\Generator $faker) {
    static $userId;
    static $productId;

    return [
        'user_id' => $faker->randomElement($userId ?: $userId = App\Models\User::pluck('id')->toArray()),
        'product_id' => $faker->randomElement($productId ?: $productId = App\Models\Product::pluck('id')->toArray()),
        'point' => $faker->numberBetween(1, 5),
    ];
});

$factory->define(App\Models\SuggestProduct::class, function (Faker\Generator $faker) {
    static $userId;
    static $categoryId;

    return [
        'product_name' => $faker->name,
        'category_name' => $faker->name,
        'sub_category_name' => $faker->name,
        'sub_category_id' => $faker->randomElement($categoryId ?: $categoryId = App\Models\Category::pluck('parent_id')->toArray()),
        'category_id' => $faker->randomElement($categoryId ?: $categoryId = App\Models\Category::pluck('id')->toArray()),
        'images' => config('setting.images.product'),
        'price' => $faker->numberBetween(1000, 100000),
        'number_current' => $faker->numberBetween(10, 100),
        'made_in' => $faker->company,
        'date_manufacture' => $faker->dateTime($max = 'now'),
        'date_expiration' => $faker->dateTime($max = 'now'),
        'user_id' => $faker->randomElement($userId ?: $userId = App\Models\User::pluck('id')->toArray()),
        'is_accept' => $faker->numberBetween(0, 1),
        'description' => $faker->name,
    ];
});
