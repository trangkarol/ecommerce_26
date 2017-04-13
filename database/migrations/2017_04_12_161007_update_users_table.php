<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('birthday')->after('password');
            $table->string('phone_number')->after('birthday');
            $table->string('avatar')->after('phone_number');
            $table->string('address')->after('avatar');
            $table->tinyInteger('role')->after('address');
            $table->softDeletes()->after('role');
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
            $table->dropColumn('birthday');
            $table->dropColumn('phone_number');
            $table->dropColumn('avatar');
            $table->dropColumn('address');
            $table->dropColumn('role');
            $table->dropColumn('deleted_at');
        });
    }
}
