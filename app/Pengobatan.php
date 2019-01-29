<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengobatan extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pengobatans';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['tgl_pengobatan','kandang', 'tgl_checkin', 'umur', 'vaksin', 'dosis', 'aplikasi', 'obat', 'notes', 'created_by','populasi'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function getlokasi()
    {
        return $this->belongsTo('App\Lokasi', 'kandang', 'id');
    }

}
