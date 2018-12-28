<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveCompositePrimaryKeyFromDepartmentBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('department_budgets', function (Blueprint $table) {
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
        Schema::table('department_budgets', function (Blueprint $table) {
            $table->primary(['budget_year_id', 'sector_id', 'department_id'], 'dept_budget_id');
        });
    }
}
