<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStandargrowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('standargrowers', function(Blueprint $table) {
                $table->increments('id');
                $table->string('standar')->nullable;
                $table->integer('umur')->nullable;
                $table->double('pkg0')->nullable;
                $table->double('pkg1')->nullable;
                $table->double('bbg0')->nullable;
                $table->double('bbg1')->nullable;

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
        Schema::drop('standargrowers');
    }

}
