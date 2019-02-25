<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommonUseItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('common_use_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('item_type_id')->nullable();
            $table->string('code');
            $table->string('description');
            $table->string('uom');
            $table->unsignedDecimal('price', 11, 2);
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
        Schema::dropIfExists('common_use_items');
    }
}
