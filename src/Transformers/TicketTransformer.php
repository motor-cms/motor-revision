<?php

namespace Motor\Revision\Transformers;

use League\Fractal;
use \Motor\Revision\Models\Ticket;

/**
 * Class TicketTransformer
 * @package \Motor\Revision\Transformers
 */
class TicketTransformer extends Fractal\TransformerAbstract
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
     * @param Ticket $record
     * @return array
     */
    public function transform(Ticket $record)
    {
        return [
            'id'        => (int) $record->id
        ];
    }
}
