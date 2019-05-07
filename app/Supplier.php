<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'suppliers';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'notes', 'pic', 'telp', 'pic2', 'telp2', 'pajak', 'created_by'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
