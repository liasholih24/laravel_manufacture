<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTypeFromLokasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lokasis', function (Blueprint $table) {
            $table->dropColumn('type');
            });
            Schema::table('lokasis', function (Blueprint $table) {
                $table->string('type')->after('notes')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lokasis', function (Blueprint $table) {
            //
        });
    }
}
