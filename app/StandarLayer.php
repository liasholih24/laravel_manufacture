<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StandarLayer extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'standarlayers';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['standar', 'umur', 'pkg0', 'pkg1','bbkg0', 'bbkg1', 'hd0', 'hd1', 'btg0', 'btg1'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
