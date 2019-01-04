<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Models\Activity as Activity;
use Sentinel;

class Nasabah extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'nasabahs';

  public function getgroup(){
    return $this->hasOne('App\Status','code','group_code');
  }
  public function getunit(){
    return $this->hasOne('App\Lokasi','id','unit_kerja');
  }
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
    protected $fillable = ['norek', 'nama_depan', 'nama_belakang', 'tgl_lahir', 'tipe_identitas', 'no_identitas', 'pekerjaan', 'organisasi', 'jenis_nasabah', 'alamat', 'keterangan', 'no_telp', 'unit_kerja', 'login_id', 'status', 'created_by', 'updated_by','group_code','pic'];


    protected static function boot(){

  parent::boot(); 

        static::updated(function ($nasabah) {

            $changes = $nasabah->isDirty() ? $nasabah->getDirty() : false;

            if($changes)
            {

                foreach($changes as $attr => $value)
                {
                  if($attr != "updated_at"){
                    if($attr != "updated_by" ){
                      $before = empty($nasabah->getOriginal($attr))?"<i>empty</i>": $nasabah->getOriginal($attr);
                      $after =  empty($nasabah->$attr)?"<i>empty</i>": $nasabah->$attr;

                      if($attr == "status"){
                      if(!empty($nasabah->getOriginal($attr))){
                      $status = Status::find($nasabah->getOriginal($attr));}
                      $before = empty($status->name)?"<i>empty</i>": $status->name;
                      $after =  empty($nasabah->getstatus->name)?"<i>empty</i>" : $nasabah->getstatus->name;
                          }

                    activity()->performedOn($nasabah)->causedBy(Sentinel::getUser()->id)->log("updated nasabah $attr from {$before} to {$after}");
                  }
                }

                }
              
            }

        });

    }

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
