<?php

namespace Motor\Revision\Transformers;

use League\Fractal;
use Motor\Revision\Models\Shuttle;

/**
 * Class ShuttleTransformer
 * @package Motor\Revision\Transformers
 */
class ShuttleTransformer extends Fractal\TransformerAbstract
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
     * @param Shuttle $record
     * @return array
     */
    public function transform(Shuttle $record)
    {
        return [
            'id'        => (int) $record->id
        ];
    }
}
