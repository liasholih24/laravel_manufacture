<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePengobatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('pengobatans', function(Blueprint $table) {
                $table->increments('id');
                $table->date('tgl_pengobatan')->nullable();
                $table->date('tgl_checkin')->nullable();
                $table->string('umur')->nullable();
                $table->integer('vaksin')->nullable();
                $table->double('dosis')->nullable();
                $table->string('aplikasi')->nullable();
                $table->integer('obat')->nullable();
                $table->text('notes')->nullable();
                $table->integer('created_by')->nullable();

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
        Schema::drop('pengobatans');
    }

}
