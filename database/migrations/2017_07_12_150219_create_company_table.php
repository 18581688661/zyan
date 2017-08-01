<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_account');
            $table->string('password', 60);
            $table->string('company_name');
            $table->string('email');
            $table->string('company_address');
            $table->string('postalcode');
            $table->string('company_introduction');
            $table->string('business_licence');
            $table->string('organization_code');
            $table->integer('role')->default(1);
            $table->integer('activated')->default(0);
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
        Schema::drop('company');
    }
}
