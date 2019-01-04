<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Models\Activity as Activity;
use Sentinel;

class Penadah extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'penadahs';


     public function createdby(){
    return $this->hasOne('App\User','id','created_by');
  }
  public function updatedby(){
    return $this->hasOne('App\User','id','updated_by');
  }
  public function getstatus(){
    return $this->hasOne('App\Status','id','status');
  }

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'name', 'notes', 'address', 'phone', 'pic', 'status', 'created_by', 'updated_by'];


      protected static function boot(){

  parent::boot(); 

        static::updated(function ($penadah) {

            $changes = $penadah->isDirty() ? $penadah->getDirty() : false;

            if($changes)
            {

                foreach($changes as $attr => $value)
                {
                  if($attr != "updated_at"){
                    if($attr != "updated_by" ){
                      $before = empty($penadah->getOriginal($attr))?"<i>empty</i>": $penadah->getOriginal($attr);
                      $after =  empty($penadah->$attr)?"<i>empty</i>": $penadah->$attr;

                      if($attr == "status"){
                      if(!empty($penadah->getOriginal($attr))){
                      $status = Status::find($penadah->getOriginal($attr));}
                      $before = empty($status->name)?"<i>empty</i>": $status->name;
                      $after =  empty($penadah->getstatus->name)?"<i>empty</i>" : $penadah->getstatus->name;
                          }

                    activity()->performedOn($penadah)->causedBy(Sentinel::getUser()->id)->log("updated penadah $attr from {$before} to {$after}");
                  }
                }

                }
              
            }

        });

    }

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
