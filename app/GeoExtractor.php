<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeoExtractor extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'geo_extractors';

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
    protected $fillable = ['title', 'type', 'generic', 'genericFormat', 'lat', 'latFormat', 'long', 'longFormat', 'enabled', 'order'];
}
