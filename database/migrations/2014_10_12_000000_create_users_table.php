<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';//设置存储引擎
            $table->increments('id');
            $table->string('username');
            $table->string('password', 60);
            $table->string('real_name')->nullable();
            $table->string('mobile')->unique();
            $table->string('gender')->nullable();
            $table->string('ID_card')->nullable();
            $table->string('address')->nullable();
            $table->string('plate')->nullable();
            $table->string('model')->nullable();
            $table->string('driver_licence_num')->nullable();
            $table->integer('company')->nullable();
            $table->integer('role')->default(2);
            $table->string('delivery_address')->nullable();
            $table->string('image_url')->nullable();
            $table->string('device_state')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
