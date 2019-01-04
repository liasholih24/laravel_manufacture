<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Models\Activity as Activity;
use Sentinel;
class Satuan extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'satuans';

 public function getbasis(){
    return $this->hasOne('App\Satuan','id','basis');
  }

  public function getstatus(){
    return $this->hasOne('App\Status','id','status');
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
    protected $fillable = ['code', 'name', 'standard_value', 'status', 'created_by', 'updated_by','desc','basis'];

    protected static function boot(){

  parent::boot(); 

        static::updated(function ($satuan) {

            $changes = $satuan->isDirty() ? $satuan->getDirty() : false;

            if($changes)
            {

                foreach($changes as $attr => $value)
                {
                  if($attr != "updated_at"){
                    if($attr != "updated_by" ){
                      $before = empty($satuan->getOriginal($attr))?"<i>empty</i>": $satuan->getOriginal($attr);
                      $after =  empty($satuan->$attr)?"<i>empty</i>": $satuan->$attr;

                      if($attr == "status"){
                      if(!empty($satuan->getOriginal($attr))){
                      $status = Status::find($satuan->getOriginal($attr));}
                      $before = empty($status->name)?"<i>empty</i>": $status->name;
                      $after =  empty($satuan->getstatus->name)?"<i>empty</i>" : $satuan->getstatus->name;
                          }

                    activity()->performedOn($satuan)->causedBy(Sentinel::getUser()->id)->log("updated satuan $attr from {$before} to {$after}");
                  }
                }

                }
              
            }

        });

    }

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
