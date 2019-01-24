<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_years', function (Blueprint $table) {
            $table->increments('id');
            $table->year('budget_year')->unique();
            $table->unsignedDecimal('fund_101', 11, 2);
            $table->unsignedDecimal('fund_164', 11, 2);
            $table->boolean('is_active')->default(false);
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
        Schema::dropIfExists('budget_years');
    }
}
