<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResourceClass extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'resource_classes';

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
    protected $fillable = ['classUrl', 'enabled', 'pagination', 'pagination_size'];
}
