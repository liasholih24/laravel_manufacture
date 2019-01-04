<?php
namespace App;

use Baum\Node;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Models\Activity as Activity;
use Sentinel;
/**
* Sampah
*/
class Sampah extends Node {
  /**
   * Table name.
   *
   * @var string
   */
  protected $table = 'sampahs';

  public function sampah(){
    return $this->hasOne('App\Sampah','id','parent_id');
  }
  public function getsatuan(){
    return $this->hasOne('App\Satuan','id','satuan');
  }
  public function gettype(){
    return $this->hasOne('App\Status','id','type');
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

  // 'parent_id' column name
  protected $parentColumn = 'parent_id';

  // 'lft' column name
  protected $leftColumn = 'lidx';

  // 'rgt' column name
  protected $rightColumn = 'ridx';

  // 'depth' column name
  protected $depthColumn = 'nesting';





  protected static function boot(){

  parent::boot(); 

        static::updated(function ($sampah) {

            $changes = $sampah->isDirty() ? $sampah->getDirty() : false;

            if($changes)
            {

                foreach($changes as $attr => $value)
                {
                  if($attr != "updated_at"){
                    if($attr != "updated_by" ){
                      $before = empty($sampah->getOriginal($attr))?"<i>empty</i>": $sampah->getOriginal($attr);
                      $after =  empty($sampah->$attr)?"<i>empty</i>": $sampah->$attr;

                      if($attr == "status"){
                      if(!empty($sampah->getOriginal($attr))){
                      $status = Status::find($sampah->getOriginal($attr));}
                      $before = empty($status->name)?"<i>empty</i>": $status->name;
                      $after =  empty($sampah->getstatus->name)?"<i>empty</i>" : $sampah->getstatus->name;
                          }

                    activity()->performedOn($sampah)->causedBy(Sentinel::getUser()->id)->log("updated sampah $attr from {$before} to {$after}");
                  }
                }

                }
              
            }

        });

    }

    use SoftDeletes;
    protected $dates = ['deleted_at'];

  // guard attributes from mass-assignment
  //protected $guarded = array('id', 'parent_id', 'lidx', 'ridx', 'nesting','name');


  //////////////////////////////////////////////////////////////////////////////

  //
  // Below come the default values for Baum's own Nested Set implementation
  // column names.
  //
  // You may uncomment and modify the following fields at your own will, provided
  // they match *exactly* those provided in the migration.
  //
  // If you don't plan on modifying any of these you can safely remove them.
  //

  // /**
  //  * Column name which stores reference to parent's node.
  //  *
  //  * @var string
  //  */
  // protected $parentColumn = 'parent_id';

  // /**
  //  * Column name for the left index.
  //  *
  //  * @var string
  //  */
  // protected $leftColumn = 'lft';

  // /**
  //  * Column name for the right index.
  //  *
  //  * @var string
  //  */
  // protected $rightColumn = 'rgt';

  // /**
  //  * Column name for the depth field.
  //  *
  //  * @var string
  //  */
  // protected $depthColumn = 'depth';

  // /**
  //  * Column to perform the default sorting
  //  *
  //  * @var string
  //  */
  // protected $orderColumn = null;

  // /**
  // * With Baum, all NestedSet-related fields are guarded from mass-assignment
  // * by default.
  // *
  // * @var array
  // */
  // protected $guarded = array('id', 'parent_id', 'lft', 'rgt', 'depth');

  //
  // This is to support "scoping" which may allow to have multiple nested
  // set trees in the same database table.
  //
  // You should provide here the column names which should restrict Nested
  // Set queries. f.ex: company_id, etc.
  //

  // /**
  //  * Columns which restrict what we consider our Nested Set list
  //  *
  //  * @var array
  //  */
  // protected $scoped = array();

  //////////////////////////////////////////////////////////////////////////////

  //
  // Baum makes available two model events to application developers:
  //
  // 1. `moving`: fired *before* the a node movement operation is performed.
  //
  // 2. `moved`: fired *after* a node movement operation has been performed.
  //
  // In the same way as Eloquent's model events, returning false from the
  // `moving` event handler will halt the operation.
  //
  // Please refer the Laravel documentation for further instructions on how
  // to hook your own callbacks/observers into this events:
  // http://laravel.com/docs/5.0/eloquent#model-events

}
