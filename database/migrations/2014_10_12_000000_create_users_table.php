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
            $table->string('name', 50)->nullable();
            $table->string('surname', 50)->nullable();
            $table->string('company_name', 100)->nullable();
            $table->string('telephone', 50)->nullable();
            $table->string('document_id', 20)->nullable();
            $table->string('region', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('email', 50)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('availability')->nullable();
            $table->integer('gender')->nullable();
            $table->date('birthday')->default('0001-01-01');
            $table->string('schedule')->nullable();
            $table->string('address')->nullable();
            $table->boolean('user_type')->default(1);
            $table->boolean('state')->default(1);
            $table->string('password', 100);
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
