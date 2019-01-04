<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transfer extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'transfers';

    public function gudangfrom(){
    return $this->hasOne('App\Lokasi','id','gdg_from');
    }
    public function gudangto(){
    return $this->hasOne('App\Lokasi','id','gdg_to');
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
    protected $fillable = ['gdg_from', 'gdg_to', 'qty_kg', 'keterangan', 'created_by', 'updated_by'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
