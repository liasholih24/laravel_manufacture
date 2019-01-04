<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSedekahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('sedekahs', function(Blueprint $table) {
                $table->increments('id');
                $table->string('code');
$table->integer('perusahaan');
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
        Schema::drop('sedekahs');
    }

}
