<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produksi extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'produksis';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['prod_tgl', 'kandang', 'strain','umur'
                    , 'jml_awal','jml_mati', 'jml_masuk', 'jml_pindah','jml_so','jml_afkir','jml_akhir'
                    , 'pakan_jenis', 'pakan_qty', 'pakan_satuan'
                    , 'p_utuh_butir', 'p_utuh_kg'
                    , 'p_putih_butir', 'p_putih_kg'
                    , 'p_retak_butir', 'p_retak_kg'
                    , 'gr_butir'
                    , 'kg_1000'
                    , 'hd'
                    , 'fc'
                    , 'ttl_butir'
                    , 'ttl_kg'
                    , 'created_by'
                    , 'updated_by'
                ];

    //use SoftDeletes;
    //protected $dates = ['deleted_at'];

    public function getlokasi()
    {
        return $this->belongsTo('App\Lokasi', 'kandang', 'id');
    }

}
