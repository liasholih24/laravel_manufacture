<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ekspedisi extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ekspedisi';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'desc', 'created_at'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
