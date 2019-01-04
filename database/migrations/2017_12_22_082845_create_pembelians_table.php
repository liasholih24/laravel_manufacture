<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('pembelians', function(Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
$table->string('gudang')->nullable();
$table->text('keterangan')->nullable();
$table->integer('created_by')->nullable();
$table->integer('updated_by')->nullable();
$table->string('code')->nullable();

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
        Schema::drop('pembelians');
    }

}
