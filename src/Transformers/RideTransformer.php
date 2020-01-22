<?php

namespace Motor\Revision\Transformers;

use League\Fractal;
use Motor\Revision\Models\Ride;

/**
 * Class RideTransformer
 * @package Motor\Revision\Transformers
 */
class RideTransformer extends Fractal\TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [];


    /**
     * Transform record to array
     *
     * @param Ride $record
     * @return array
     */
    public function transform(Ride $record)
    {
        return [
            'id'        => (int) $record->id
        ];
    }
}
