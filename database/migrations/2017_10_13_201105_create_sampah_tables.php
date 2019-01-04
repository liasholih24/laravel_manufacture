<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSampahTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sampahs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable()->index();
            $table->integer('lidx')->nullable()->index();
            $table->integer('ridx')->nullable()->index();
            $table->text('title')->nullable();
            $table->text('subtitle')->nullable();
            $table->text('depthname')->nullable();
            $table->text('depthicon')->nullable();
            $table->integer('nesting')->nullable();
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->text('note')->nullable();
            $table->boolean('status')->default(0);
            $table->integer('updated_by')->nullable();
            $table->string('created_by')->nullable(); 
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
        Schema::table('items', function (Blueprint $table) {
            //
        });
    }
}
