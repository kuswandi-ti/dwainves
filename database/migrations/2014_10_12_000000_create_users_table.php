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
            $table->bigIncrements('id');
			$table->string('username')->nullable()->unique();
            $table->string('password')->nullable();            
            $table->string('email')->nullable()->unique();
            $table->boolean('email_verified')->nullable();
			$table->bigInteger('vendor_id')->nullable();
			$table->string('vendor_code')->nullable();
			$table->string('fullname')->nullable();
            $table->string('jabatan')->nullable();
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
        Schema::dropIfExists('users');
    }
}
