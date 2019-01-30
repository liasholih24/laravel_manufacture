<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTtlBiayaToHargapokoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hargapokoks', function (Blueprint $table) {
            $table->double('ttl_biaya')->after('t_rusak')->nullable();
            $table->double('ttl_produksi')->after('ttl_biaya')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hargapokoks', function (Blueprint $table) {
            //
        });
    }
}
