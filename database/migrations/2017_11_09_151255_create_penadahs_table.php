<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePenadahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('penadahs', function(Blueprint $table) {
                $table->increments('id');
                $table->string('code');
                $table->string('name');
                $table->text('notes')->nullable();
                $table->text('address')->nullable();
                $table->integer('phone')->nullable();
                $table->string('pic')->nullable();
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
        Schema::drop('penadahs');
    }

}
