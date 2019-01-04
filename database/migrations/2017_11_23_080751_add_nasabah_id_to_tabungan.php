<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNasabahIdToTabungan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tabungans', function (Blueprint $table) {
            $table->string('nasabah_id')->after('norek');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tabungans', function (Blueprint $table) {
            $table->dropColumn('nasabah_id');
        });
    }
}
