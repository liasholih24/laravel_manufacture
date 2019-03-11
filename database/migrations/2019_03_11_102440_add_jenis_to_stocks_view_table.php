<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJenisToStocksViewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("drop view if exists v_stocks");
        DB::statement("create view v_stocks AS SELECT `b`.`number` AS `noref`,`b`.`date` AS `date`,`c`.`id` AS `item_id`,`c`.`name` AS `item`,`d`.`name` AS `satuan`,`f`.`name` AS `jenis`,`e`.`id` AS `gudang_id`,`e`.`name` AS `gudang`,`a`.`qty` AS `qty`,`a`.`qty` AS `qty_in`,0 AS `qty_out`,`a`.`price` AS `saldo`,`a`.`price` AS `saldo_in`,0 AS `saldo_out`,`a`.`created_at` AS `created_at` FROM ((((`detailpenerimaans` `a` JOIN `penerimaans` `b` ON (`a`.`penerimaan_id`=`b`.`id` AND `a`.`deleted_at` IS NULL)) JOIN `items` `c` ON (`a`.`item_id`=`c`.`id` AND `c`.`nesting`=1)) JOIN `satuans` `d` ON (`c`.`satuan`=`d`.`id`)) JOIN `lokasis` `e` ON (`b`.`storage_id`=`e`.`id`)) JOIN `items` `f` ON (`c`.`parent_id`=`f`.`id` AND `f`.`nesting`=0) UNION
        SELECT `b`.`number` AS `noref`,`b`.`date` AS `date`,`c`.`id` AS `item_id`,`c`.`name` AS `item`,`d`.`name` AS `satuan`,`f`.`name` AS `jenis`,`e`.`id` AS `gudang_id`,`e`.`name` AS `gudang`,`a`.`qty` AS `qty`,0 AS `qty_in`,`a`.`qty` AS `qty_out`,`a`.`price` AS `saldo`,0 AS `saldo_in`,`a`.`price` AS `saldo_out`,`a`.`created_at` AS `created_at` FROM ((((`detailpenjualans` `a` JOIN `penjualans` `b` ON (`a`.`penjualan_id`=`b`.`id` AND `a`.`deleted_at` IS NULL)) JOIN `items` `c` ON (`a`.`item_id`=`c`.`id` AND `c`.`nesting`=1)) JOIN `satuans` `d` ON (`c`.`satuan`=`d`.`id`)) JOIN `lokasis` `e` ON (`b`.`storage_id`=`e`.`id`)) JOIN `items` `f` ON (`c`.`parent_id`=`f`.`id` AND `f`.`nesting`=0) UNION
        SELECT `b`.`number` AS `noref`,`b`.`date` AS `date`,`c`.`id` AS `item_id`,`c`.`name` AS `item`,`d`.`name` AS `satuan`,`g`.`name` AS `jenis`,`f`.`id` AS `gudang_id`,`f`.`name` AS `gudang`,`a`.`qty` AS `qty`,0 AS `qty_in`,`a`.`qty` AS `qty_out`,0 AS `saldo`,0 AS `saldo_in`,0 AS `saldo_out`,`a`.`created_at` AS `created_at` FROM (((((`detailpemakaians` `a` JOIN `pemakaians` `b` ON (`a`.`pemakaian_id`=`b`.`id` AND `a`.`deleted_at` IS NULL)) JOIN `items` `c` ON (`a`.`item_id`=`c`.`id` AND `c`.`nesting`=1)) JOIN `satuans` `d` ON (`c`.`satuan`=`d`.`id`)) JOIN `lokasis` `e` ON (`b`.`storage_id`=`e`.`id`)) JOIN `lokasis` `f` ON (`e`.`parent_id`=`f`.`id`)) JOIN `items` `g` ON (`c`.`parent_id`=`g`.`id` AND `g`.`nesting`=0) UNION
        SELECT `b`.`number` AS `noref`,`b`.`date` AS `date`,`c`.`id` AS `item_id`,`c`.`name` AS `item`,`d`.`name` AS `satuan`,`f`.`name` AS `jenis`,`e`.`id` AS `gudang_id`,`e`.`name` AS `gudang`,`a`.`qty` AS `qty`,0 AS `qty_in`,`a`.`qty` AS `qty_out`,0 AS `saldo`,0 AS `saldo_in`,0 AS `saldo_out`,`a`.`created_at` AS `created_at` FROM ((((`detailtransfers` `a` JOIN `transfers` `b` ON (`a`.`transfer_id`=`b`.`id` AND `a`.`deleted_at` IS NULL)) JOIN `items` `c` ON (`a`.`item_id`=`c`.`id` AND `c`.`nesting`=1)) JOIN `satuans` `d` ON (`c`.`satuan`=`d`.`id`)) JOIN `lokasis` `e` ON (`b`.`gdg_from`=`e`.`id`)) JOIN `items` `f` ON (`c`.`parent_id`=`f`.`id` AND `f`.`nesting`=0) UNION
        SELECT `b`.`number` AS `noref`,`b`.`date` AS `date`,`c`.`id` AS `item_id`,`c`.`name` AS `item`,`d`.`name` AS `satuan`,`f`.`name` AS `jenis`,`e`.`id` AS `gudang_id`,`e`.`name` AS `gudang`,`a`.`qty` AS `qty`,`a`.`qty` AS `qty_in`,0 AS `qty_out`,0 AS `saldo`,0 AS `saldo_in`,0 AS `saldo_out`,`a`.`created_at` AS `created_at` FROM ((((`detailtransfers` `a` JOIN `transfers` `b` ON (`a`.`transfer_id`=`b`.`id` AND `a`.`deleted_at` IS NULL)) JOIN `items` `c` ON (`a`.`item_id`=`c`.`id` AND `c`.`nesting`=1)) JOIN `satuans` `d` ON (`c`.`satuan`=`d`.`id`)) JOIN `lokasis` `e` ON (`b`.`gdg_to`=`e`.`id`)) JOIN `items` `f` ON (`c`.`parent_id`=`f`.`id` AND `f`.`nesting`=0)");
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
