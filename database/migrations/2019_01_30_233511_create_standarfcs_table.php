<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStandarfcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('standarfcs', function(Blueprint $table) {
                $table->increments('id');
                $table->integer('umur0')->nullable();
                $table->integer('umur1')->nullable();
                $table->double('fc0')->nullable();
                $table->double('fc1')->nullable();

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
        Schema::drop('standarfcs');
    }

}
