<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // DB::table('users')->insert([
        //     'name' => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => bcrypt('123456'),
        //     'birthday' => '2017-03-12',
        //     'role' => 0,
        //     'phone_number' => '0165-783-954',
        //     'address' => '177 Le Duan, Hai Chau, Da Nang',
        //     'avatar' => config('setting.images.avatar'),
        //     'remember_token' => str_random(10),
        // ]);

        factory(App\Models\User::class, 10)->create();
    }
}
