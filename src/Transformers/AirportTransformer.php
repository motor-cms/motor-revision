<?php

namespace Motor\Revision\Transformers;

use League\Fractal;
use Motor\Revision\Models\Airport;

/**
 * Class AirportTransformer
 * @package Motor\Revision\Transformers
 */
class AirportTransformer extends Fractal\TransformerAbstract
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
     * @param Airport $record
     * @return array
     */
    public function transform(Airport $record)
    {
        return [
            'id'        => (int) $record->id
        ];
    }
}
