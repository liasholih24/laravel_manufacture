<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailtransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailtransfers', function(Blueprint $table) {
                 $table->increments('id');
                 $table->integer('gdg_from')->nullable();
                 $table->integer('gdg_to')->nullable();
            $table->integer('sampah')->nullable();
            $table->string('satuan')->nullable();
            $table->integer('jumlah')->nullable();
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
