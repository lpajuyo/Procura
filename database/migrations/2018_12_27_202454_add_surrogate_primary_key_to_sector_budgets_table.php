<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSurrogatePrimaryKeyToSectorBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sector_budgets', function (Blueprint $table) {
            $table->increments('id')->first();

            $table->unique(['budget_year_id', 'sector_id'], 'unique_index_for_natural_key');
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
            $table->dropColumn('id');

            $table->dropUnique('unique_index_for_natural_key');
        });
    }
}
