<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProduksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('produksis', function(Blueprint $table) {
                $table->increments('id');
                $table->date('prod_tgl')->nullable();
                $table->integer('kandang')->nullable();
                $table->double('umur')->nullable();
                $table->double('jml_mati')->nullable();
                $table->double('jml_masuk')->nullable();
                $table->double('jml_akhir')->nullable();
                $table->integer('pakan_jenis')->nullable();
                $table->double('pakan_qty')->nullable();
                $table->integer('pakan_satuan')->nullable();
                $table->double('p_utuh_butir')->nullable();
                $table->double('p_utuh_kg')->nullable();
                $table->double('p_retak_butir')->nullable();
                $table->double('p_retak_kg')->nullable();
                $table->double('gr_butir')->nullable();
                $table->double('kg_1000')->nullable();
                $table->double('hd')->nullable();
                $table->double('fc')->nullable();

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
        Schema::drop('produksis');
    }

}
