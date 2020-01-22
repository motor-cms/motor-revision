<?php

namespace Motor\Revision\Transformers;

use League\Fractal;
use Motor\Revision\Models\Hotel;

/**
 * Class HotelTransformer
 * @package Motor\Revision\Transformers
 */
class HotelTransformer extends Fractal\TransformerAbstract
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
     * @param Hotel $record
     * @return array
     */
    public function transform(Hotel $record)
    {
        return [
            'id'        => (int) $record->id
        ];
    }
}
