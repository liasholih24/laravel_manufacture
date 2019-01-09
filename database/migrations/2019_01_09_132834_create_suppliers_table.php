<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('suppliers', function(Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->text('notes')->nullable();
                $table->string('pic')->nullable();
                $table->string('telp')->nullable();
                $table->integer('created_by')->nullable();
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
        Schema::drop('suppliers');
    }

}
