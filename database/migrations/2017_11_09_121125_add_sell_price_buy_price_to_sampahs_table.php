<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSellPriceBuyPriceToSampahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sampahs', function (Blueprint $table) {
            $table->decimal('sell_price', 12, 2)->nullable();
            $table->decimal('buy_price', 12, 2)->nullable();
            $table->integer('satuan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sampahs', function (Blueprint $table) {
            //
        });
    }
}
