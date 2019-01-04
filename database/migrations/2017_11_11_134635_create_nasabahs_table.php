<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNasabahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('nasabahs', function(Blueprint $table) {
                $table->increments('id');
                $table->string('norek');
                $table->string('nama_depan');
                $table->string('nama_belakang')->nullable();
                $table->date('tgl_lahir')->nullable();
                $table->string('tipe_identitas')->nullable();
                $table->string('no_identitas')->nullable();
                $table->string('pekerjaan')->nullable();
                $table->string('organisasi')->nullable();
                $table->integer('jenis_nasabah')->nullable();
                $table->text('alamat')->nullable();
                $table->text('keterangan')->nullable();
                $table->string('no_telp')->nullable();
                $table->integer('unit_kerja')->nullable();
                $table->integer('login_id')->nullable();
                $table->integer('status');
                $table->integer('created_by');
                $table->integer('updated_by');

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
        Schema::drop('nasabahs');
    }

}
