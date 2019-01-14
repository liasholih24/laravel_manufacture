<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->double('panjang')->nullable();
            $table->double('lebar')->nullable();
            $table->double('tinggi')->nullable();
            $table->string('dimensi_satuan')->nullable();
            $table->double('berat')->nullable();
            $table->string('berat_satuan')->nullable();
            $table->double('kapasitas')->nullable();
            $table->string('kapasitas_satuan')->nullable();
            $table->double('minstock')->nullable();
            $table->double('maxstock')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            //
        });
    }
}
