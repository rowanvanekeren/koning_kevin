<?php

use Illuminate\Support\Facades\Schema;
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
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('city');
            $table->string('country');
            $table->string('job')->nullable();
            $table->string('job_function')->nullable();
            $table->string('gender');
            $table->date('birth_date');
            $table->string('birth_place');
            $table->string('url')->nullable();
            $table->tinyInteger('is_active')->default(0);
            $table->tinyInteger('is_admin')->default(0);
            $table->integer('administrative_details_id')->index()->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->softDeletes();
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
