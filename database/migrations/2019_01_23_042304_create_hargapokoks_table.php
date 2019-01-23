<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHargapokoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('hargapokoks', function(Blueprint $table) {
                $table->increments('id');
                $table->date('tgl_hpp')->nullable();
                $table->string('jenis')->nullable();
                $table->double('b_gaji_kandang')->nullable();
                $table->double('b_gaji_angkutan')->nullable();
                $table->double('b_lembur')->nullable();
                $table->double('b_transpakan')->nullable();
                $table->double('b_bongkar')->nullable();
                $table->double('b_pakan')->nullable();
                $table->double('b_obat')->nullable();
                $table->double('b_listrik')->nullable();
                $table->double('b_servis')->nullable();
                $table->double('t_utuh')->nullable();
                $table->double('t_rusak')->nullable();
                $table->double('hpp')->nullable();
                $table->double('hpp_adm')->nullable();
                $table->double('hpp_prod')->nullable();

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
        Schema::drop('hargapokoks');
    }

}
