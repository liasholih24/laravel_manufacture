<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQtyToViewStocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("drop view if exists v_recap_stocks");
        DB::statement("create view v_recap_stocks as select `a`.`gudang_id` AS `gudang_id`,`a`.`gudang` AS `gudang`,`a`.`item` AS `item`,sum(`a`.`qty_in`) AS `qty_in`,sum(`a`.`qty_out`) AS `qty_out`,sum(`a`.`qty_in`) - sum(`a`.`qty_out`) as qty, max(`a`.`created_at`) AS `created_at` from `v_stocks` `a` group by `a`.`gudang_id`,`a`.`gudang`,`a`.`item_id`,`a`.`item` order by `a`.`gudang_id`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("drop view if exists v_recap_stocks");
    }
}
