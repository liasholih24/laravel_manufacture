<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyHargapokoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hargapokoks', function (Blueprint $table) {
            $table->dropColumn('jenis');
        });

        Schema::table('hargapokoks', function (Blueprint $table) {
            $table->double('b_prodadmin')->after('b_servis')->nullable();
            $table->double('b_penyusutan')->after('b_prodadmin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hargapokoks', function (Blueprint $table) {
            //
        });
    }
}
