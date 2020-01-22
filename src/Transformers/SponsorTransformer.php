<?php

namespace Motor\Revision\Transformers;

use League\Fractal;
use Motor\Revision\Models\Sponsor;

/**
 * Class SponsorTransformer
 * @package Motor\Revision\Transformers
 */
class SponsorTransformer extends Fractal\TransformerAbstract
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
     * @param Sponsor $record
     * @return array
     */
    public function transform(Sponsor $record)
    {
        return [
            'id'        => (int) $record->id
        ];
    }
}
