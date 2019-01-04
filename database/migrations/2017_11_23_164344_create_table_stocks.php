<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('sampah')->nullable();
            $table->string('satuan')->nullable();
            $table->integer('qty')->nullable();
            $table->float('qty_in')->nullable();
            $table->float('qty_out')->nullable();
            $table->float('saldo')->nullable();
            $table->integer('gudang')->nullable();
            $table->integer('noref')->nullable();

            $table->timestamps();
            $table->softDeletes();

         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
