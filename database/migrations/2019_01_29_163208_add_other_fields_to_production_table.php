<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOtherFieldsToProductionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

       DB::statement("ALTER TABLE produksis MODIFY COLUMN jml_mati DOUBLE NOT NULL DEFAULT '0' ");
       DB::statement("ALTER TABLE produksis MODIFY COLUMN jml_masuk DOUBLE NOT NULL DEFAULT '0' ");
       DB::statement("ALTER TABLE produksis MODIFY COLUMN jml_akhir DOUBLE NOT NULL DEFAULT '0' ");
       DB::statement("ALTER TABLE produksis MODIFY COLUMN pakan_qty DOUBLE NOT NULL DEFAULT '0' ");
       DB::statement("ALTER TABLE produksis MODIFY COLUMN p_utuh_butir DOUBLE NOT NULL DEFAULT '0' ");
       DB::statement("ALTER TABLE produksis MODIFY COLUMN p_utuh_kg DOUBLE NOT NULL DEFAULT '0' ");
       DB::statement("ALTER TABLE produksis MODIFY COLUMN p_retak_butir DOUBLE NOT NULL DEFAULT '0' ");
       DB::statement("ALTER TABLE produksis MODIFY COLUMN p_retak_kg DOUBLE NOT NULL DEFAULT '0' ");
       DB::statement("ALTER TABLE produksis MODIFY COLUMN gr_butir DOUBLE NOT NULL DEFAULT '0' ");
       DB::statement("ALTER TABLE produksis MODIFY COLUMN kg_1000 DOUBLE NOT NULL DEFAULT '0' ");
       DB::statement("ALTER TABLE produksis MODIFY COLUMN hd DOUBLE NOT NULL DEFAULT '0' ");
       DB::statement("ALTER TABLE produksis MODIFY COLUMN fc DOUBLE NOT NULL DEFAULT '0' ");

    
        Schema::table('produksis', function (Blueprint $table) {
            $table->double('jml_pindah')->after('jml_masuk')->default(0);
            $table->double('jml_so')->after('jml_pindah')->default(0);
            $table->double('ttl_butir')->after('fc')->default(0);
            $table->double('ttl_kg')->after('ttl_butir')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('productions', function (Blueprint $table) {
            //
        });
    }
}
