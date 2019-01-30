<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StandarFc extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'standarfcs';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['umur0', 'umur1', 'fc0', 'fc1'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
