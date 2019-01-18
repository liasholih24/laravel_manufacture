<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDetailpenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('detailpenjualans');
        Schema::create('detailpenjualans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('penjualan_id');
            $table->unsignedInteger('item_id');
            $table->double('qty', 16, 2);
            $table->double('price', 19, 2);
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
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
        Schema::table('detailpenjualans', function (Blueprint $table) {
            //
        });
    }
}
