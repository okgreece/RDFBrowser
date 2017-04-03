<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class Graph extends Model implements StaplerableInterface
{
    public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('graph', [
            
        ]);

        parent::__construct($attributes);
    }
    
    use EloquentTrait;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'graphs';

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
    protected $fillable = ['graph_name', 'graph'];
}
