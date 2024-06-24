<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUpdateEmpidToMerchFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('MERCH_FEES', function (Blueprint $table) {
            $table->unsignedBigInteger('UPDATE_EMPID')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('MERCH_FEES', function (Blueprint $table) {
            $table->dropColumn('UPDATE_EMPID');
        });
    }
}
