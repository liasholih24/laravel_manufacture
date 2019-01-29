<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyPengobatanTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::table('pengobatans', function (Blueprint $table) {
            $table->dropColumn('tgl_pengobatan');
            $table->dropColumn('vaksin');
       });
       Schema::table('pengobatans', function (Blueprint $table) {
           $table->string('tgl_pengobatan')->after('tgl_checkin')->nullable();
       });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengobatans', function (Blueprint $table) {
            //
        });
    }
}
