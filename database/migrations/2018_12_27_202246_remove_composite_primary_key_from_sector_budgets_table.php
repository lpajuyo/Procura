<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveCompositePrimaryKeyFromSectorBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sector_budgets', function (Blueprint $table) {
            $table->dropPrimary('PRIMARY');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sector_budgets', function (Blueprint $table) {
            $table->primary(['budget_year_id', 'sector_id']);
        });
    }
}
