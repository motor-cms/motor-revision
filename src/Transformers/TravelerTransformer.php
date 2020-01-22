<?php

namespace Motor\Revision\Transformers;

use League\Fractal;
use Motor\Revision\Models\Traveler;

/**
 * Class TravelerTransformer
 * @package Motor\Revision\Transformers
 */
class TravelerTransformer extends Fractal\TransformerAbstract
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
     * @param Traveler $record
     * @return array
     */
    public function transform(Traveler $record)
    {
        return [
            'id'        => (int) $record->id
        ];
    }
}
