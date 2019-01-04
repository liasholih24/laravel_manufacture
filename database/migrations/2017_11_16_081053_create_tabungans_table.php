<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTabungansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('tabungans', function(Blueprint $table) {
                $table->increments('id');
                $table->string('norek');
$table->string('code');
$table->double('debit');
$table->double('kredit');
$table->double('saldo');
$table->integer('saldo_sampah');
$table->text('keterangan');
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
        Schema::drop('tabungans');
    }

}
