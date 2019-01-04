<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSatuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('satuans', function(Blueprint $table) {
                $table->increments('id');
                $table->string('code',10);
                $table->string('name',100);
                $table->text('desc')->nullable();
                $table->decimal('standard_value', 12, 2)->nullable();
                $table->integer('basis')->nullable();
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
        Schema::drop('satuans');
    }

}
