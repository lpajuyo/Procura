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
            $table->unsignedInteger('user_type_id');
            $table->string('username')->unique();
            $table->string('name');
            $table->string('position');
            //$table->string('email')->unique();
            //$table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->nullableMorphs('userable');
            $table->string('user_image')->default('user_images/default.png');
            $table->string('user_signature')->nullable();
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
