<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailPenjualan extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'detailpenjualans';

    public function createdby(){
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function updatedby(){
        return $this->hasOne('App\User', 'id', 'updated_by');
    }

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['penjualan_id', 'item_id', 'qty', 'satuan_id', 'price', 'created_by', 'updated_by', 'created_at'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
