<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proxy extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'proxies';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'name';

    public $incrementing = false;
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['url', 'name'];
}
