<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSocialiteUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->nullable()->change();
            $table->date('birthday')->nullable()->after('password')->change();
            $table->string('phone_number')->nullable()->after('birthday')->change();
            $table->string('avatar')->nullable()->after('phone_number')->change();
            $table->string('address')->nullable()->after('avatar')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->change();
            $table->date('birthday')->after('password')->change();
            $table->string('phone_number')->after('birthday')->change();
            $table->string('avatar')->after('phone_number')->change();
            $table->string('address')->after('avatar')->change();
        });
    }
}
