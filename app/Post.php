<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'header', 'content', 'thumbnail', 'author', 'date_posted'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function getAuthor()
    {
        return $this->belongsTo('App\User', 'author', 'id');
    }
}
