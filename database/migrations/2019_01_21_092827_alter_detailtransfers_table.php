<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDetailtransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detailtransfers', function (Blueprint $table) {
            $table->dropColumn(['gdg_from', 'gdg_to', 'sampah', 'satuan', 'jumlah', 'noref']);
            $table->unsignedInteger('transfer_id')->after('id');
            $table->unsignedInteger('item_id')->after('transfer_id');
            $table->double('qty', 16, 2)->after('item_id');
            $table->unsignedInteger('created_by')->nullable()->after('qty');
            $table->unsignedInteger('updated_by')->nullable()->after('created_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detailtransfers', function (Blueprint $table) {
            //
        });
    }
}
