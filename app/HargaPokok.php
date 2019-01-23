<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HargaPokok extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hargapokoks';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['tgl_hpp', 'jenis', 'b_gaji_kandang', 'b_gaji_angkutan'
                        , 'b_lembur', 'b_transpakan', 'b_bongkar'
                        , 'b_pakan', 'b_obat', 'b_listrik', 'b_servis'
                            ,'t_utuh'
                            ,'t_rusak'
                            ,'hpp'
                            ];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
