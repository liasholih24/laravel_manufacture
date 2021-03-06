<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailsedekahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailsedekahs', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('sampah')->nullable();
            $table->string('satuan')->nullable();
            $table->integer('jumlah')->nullable();
            $table->float('harga_beli')->nullable();
            $table->integer('nilai_kg')->nullable();
            $table->float('nilai_rp')->nullable();
            $table->integer('parent_id')->nullable();

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
