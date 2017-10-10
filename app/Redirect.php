<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'redirects';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['root', 'type', 'enabled', 'html', 'data'];
}
