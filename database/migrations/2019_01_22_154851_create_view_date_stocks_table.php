<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewDateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("create view v_date_stocks as select `a`.`date` AS `date`,`a`.`gudang_id` AS `gudang_id`,`a`.`gudang` AS `gudang`,`a`.`item` AS `item`,`a`.`satuan` AS `satuan`,sum(`a`.`qty_in`) AS `qty_in`,sum(`a`.`qty_out`) AS `qty_out`,max(`a`.`created_at`) AS `created_at` from `v_stocks` `a` group by `a`.`date`,`a`.`gudang_id`,`a`.`gudang`,`a`.`item`,`a`.`satuan` order by `a`.`date`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("drop view if exists v_date_stocks");
    }
}
