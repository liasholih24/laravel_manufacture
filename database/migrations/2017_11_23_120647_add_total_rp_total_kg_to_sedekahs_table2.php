<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTotalRpTotalKgToSedekahsTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sedekahs', function (Blueprint $table) {
            $table->float('total_kg')->nullable();
            $table->float('total_rp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sedekahs', function (Blueprint $table) {
            //
        });
    }
}
