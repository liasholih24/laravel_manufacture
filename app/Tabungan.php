<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tabungan extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tabungans';


    public function getnasabah()
    {
        return $this->hasOne('App\Nasabah', 'norek', 'norek');
    }

    public function createdby()
    {
        return $this->hasOne('App\User', 'id', 'created_by');
    }
    public function updatedby()
    {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['norek', 'nasabah_id', 'code', 'debit', 'kredit', 'saldo', 'saldo_sampah', 'keterangan', 'created_by', 'updated_by','trx_code','print_code','unit_kerja','created_at'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
