<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pembelian extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pembelians';


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
    protected $fillable = ['name', 'gudang', 'keterangan', 'created_by', 'updated_by', 'code','total_kg','total_rp','created_at'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
