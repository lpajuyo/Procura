<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyDepartmentBudgetsTableReflectingSectorBudgetsTableChange extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('department_budgets', function (Blueprint $table) {
            $table->dropColumn(['budget_year_id', 'sector_id']);

            $table->increments('id')->first();
            
            $table->unsignedInteger('sector_budget_id')->after('id');

            $table->unique(['sector_budget_id', 'department_id'], 'unique_index_for_natural_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('department_budgets', function (Blueprint $table) {
            $table->dropUnique('unique_index_for_natural_key');

            $table->dropColumn(['id', 'sector_budget_id']);

            $table->unsignedInteger('budget_year_id');
            $table->unsignedInteger('sector_id');
        });
    }
}
