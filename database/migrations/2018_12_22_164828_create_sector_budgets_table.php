<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectorBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sector_budgets', function (Blueprint $table) {
            $table->unsignedInteger('budget_year_id');
            $table->unsignedInteger('sector_id');
            $table->unsignedDecimal('fund_101', 11, 2);
            $table->unsignedDecimal('fund_164', 11, 2);
            $table->timestamps();

            $table->primary(['budget_year_id', 'sector_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sector_budgets');
    }
}
