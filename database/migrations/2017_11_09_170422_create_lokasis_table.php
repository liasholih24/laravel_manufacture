<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLokasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lokasis', function(Blueprint $table) {

          $table->increments('id');
          $table->integer('parent_id')->nullable()->index();
          $table->integer('lft')->nullable()->index();
          $table->integer('rgt')->nullable()->index();
          $table->integer('depth')->nullable();
          $table->string('code')->nullable();
          $table->string('name')->nullable();
          $table->text('notes')->nullable();
          $table->text('address')->nullable();
          $table->integer('type')->nullable();
          $table->integer('status')->nullable();
          $table->integer('created_by')->nullable();
          $table->integer('updated_by')->nullable();

      $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('statuses');
    }
}
