<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'stocks';

    public function getgudang(){
    return $this->hasOne('App\Lokasi','id','gudang');
    }
    public function getsampah(){
    return $this->hasOne('App\Sampah','id','sampah');
    }

    public function createdby(){
    return $this->hasOne('App\User','id','created_by');
    }

     public function updatedby(){
    return $this->hasOne('App\User','id','updated_by');
     }
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
   // protected $fillable = ['code', 'perusahaan', 'keterangan', 'created_by', 'updated_by','total_kg','total_rp'];


}
