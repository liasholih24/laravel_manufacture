<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pakan extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pakans';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'notes', 'created_by'];

    public function createdby(){
        return $this->hasOne('App\User','id','created_by');
      }
      public function updatedby(){
        return $this->hasOne('App\User','id','updated_by');
      }

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
