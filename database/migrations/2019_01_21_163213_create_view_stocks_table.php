<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("create view v_stocks as select `b`.`number` AS `noref`,`c`.`name` AS `item`,`d`.`name` AS `satuan`,NULL AS `gudang`,`a`.`qty` AS `qty`,`a`.`qty` AS `qty_in`,0 AS `qty_out`,`a`.`price` AS `saldo`,`a`.`price` AS `saldo_in`,0 AS `saldo_out`,`a`.`created_at` AS `created_at` from (((`detailpenerimaans` `a` join `penerimaans` `b` on(`a`.`penerimaan_id` = `b`.`id` and `a`.`deleted_at` is null)) join `items` `c` on(`a`.`item_id` = `c`.`id` and `c`.`nesting` = 1)) join `satuans` `d` on(`c`.`satuan` = `d`.`id`)) union select `b`.`number` AS `noref`,`c`.`name` AS `item`,`d`.`name` AS `satuan`,NULL AS `gudang`,`a`.`qty` AS `qty`,0 AS `qty_in`,`a`.`qty` AS `qty_out`,`a`.`price` AS `saldo`,0 AS `saldo_in`,`a`.`price` AS `saldo_out`,`a`.`created_at` AS `created_at` from (((`detailpenjualans` `a` join `penjualans` `b` on(`a`.`penjualan_id` = `b`.`id` and `a`.`deleted_at` is null)) join `items` `c` on(`a`.`item_id` = `c`.`id` and `c`.`nesting` = 1)) join `satuans` `d` on(`c`.`satuan` = `d`.`id`)) union select `b`.`number` AS `noref`,`c`.`name` AS `item`,`d`.`name` AS `satuan`,NULL AS `gudang`,`a`.`qty` AS `qty`,0 AS `qty_in`,`a`.`qty` AS `qty_out`,0 AS `saldo`,0 AS `saldo_in`,0 AS `saldo_out`,`a`.`created_at` AS `created_at` from (((`detailpemakaians` `a` join `pemakaians` `b` on(`a`.`pemakaian_id` = `b`.`id` and `a`.`deleted_at` is null)) join `items` `c` on(`a`.`item_id` = `c`.`id` and `c`.`nesting` = 1)) join `satuans` `d` on(`c`.`satuan` = `d`.`id`)) union select `b`.`number` AS `noref`,`c`.`name` AS `item`,`d`.`name` AS `satuan`,`b`.`gdg_from` AS `gudang`,`a`.`qty` AS `qty`,0 AS `qty_in`,`a`.`qty` AS `qty_out`,0 AS `saldo`,0 AS `saldo_in`,0 AS `saldo_out`,`a`.`created_at` AS `created_at` from (((`detailtransfers` `a` join `transfers` `b` on(`a`.`transfer_id` = `b`.`id` and `a`.`deleted_at` is null)) join `items` `c` on(`a`.`item_id` = `c`.`id` and `c`.`nesting` = 1)) join `satuans` `d` on(`c`.`satuan` = `d`.`id`)) union select `b`.`number` AS `noref`,`c`.`name` AS `item`,`d`.`name` AS `satuan`,`b`.`gdg_to` AS `gudang`,`a`.`qty` AS `qty`,`a`.`qty` AS `qty_in`,0 AS `qty_out`,0 AS `saldo`,0 AS `saldo_in`,0 AS `saldo_out`,`a`.`created_at` AS `created_at` from (((`detailtransfers` `a` join `transfers` `b` on(`a`.`transfer_id` = `b`.`id` and `a`.`deleted_at` is null)) join `items` `c` on(`a`.`item_id` = `c`.`id` and `c`.`nesting` = 1)) join `satuans` `d` on(`c`.`satuan` = `d`.`id`))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("drop view if exists v_stocks");
    }
}
