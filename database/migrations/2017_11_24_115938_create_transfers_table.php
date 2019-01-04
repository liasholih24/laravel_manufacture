<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('transfers', function(Blueprint $table) {
                $table->increments('id');
                $table->integer('gdg_from');
$table->integer('gdg_to');
$table->integer('qty_kg');
$table->string('keterangan');
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
        Schema::drop('transfers');
    }

}
