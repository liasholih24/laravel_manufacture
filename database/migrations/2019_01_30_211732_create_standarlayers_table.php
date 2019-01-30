<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStandarlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('standarlayers', function(Blueprint $table) {
                $table->increments('id');
                $table->string('standar')->nullable();
                $table->integer('umur')->nullable();
                $table->double('pkg0')->nullable();
                $table->double('pkg1')->nullable();
                $table->double('bbkg0')->nullable();
                $table->double('bbkg1')->nullable();
                $table->double('hd0')->nullable();
                $table->double('hd1')->nullable();
                $table->double('btg0')->nullable();
                $table->double('btg1')->nullable();

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
        Schema::drop('standarlayers');
    }

}
