<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StandarGrower extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'standargrowers';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['standar', 'umur', 'pkg0', 'pkg1', 'bbg0', 'bbg1'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
