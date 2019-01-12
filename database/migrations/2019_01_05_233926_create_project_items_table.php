<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_id');
            $table->string('code')->nullable();
            $table->string('description');
            $table->unsignedInteger('quantity')->nullable();
            $table->string('uom')->nullable();
            $table->unsignedDecimal('unit_cost', 11, 2)->nullable();
            $table->unsignedDecimal('estimated_budget', 11, 2);
            $table->string('procurement_mode');
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
        Schema::dropIfExists('project_items');
    }
}
