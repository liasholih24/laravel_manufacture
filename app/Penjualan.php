<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penjualan extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'penjualans';

    public function createdby(){
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function updatedby(){
        return $this->hasOne('App\User', 'id', 'updated_by');
    }

    public function getcustomer(){
        return $this->hasOne('App\Customer', 'id', 'customer_id');
    }

    public function getlokasi(){
        return $this->hasOne('App\Lokasi', 'id', 'storage_id');
    }

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['number', 'storage_id', 'customer_id', 'ekspedisi_id', 'date', 'desc', 'created_by', 'updated_by', 'created_at'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
