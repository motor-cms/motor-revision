<?php

namespace Motor\Revision\Models;

use Illuminate\Database\Eloquent\Model;
use Kra8\Snowflake\HasShortflakePrimary;
use Motor\Core\Traits\Filterable;
use Motor\Core\Traits\Searchable;

class Ticket extends Model
{
    use Filterable;
    use HasShortflakePrimary;
    use Searchable;

    /**
     * Searchable columns for the searchable trait
     *
     * @var array
     */
    protected $searchableColumns = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'handle',
        'name',
        'address',
        'zip',
        'city',
        'country',
        'company',
        'vat_id',
        'email',
        'comment',
        'internal_comment',
        'access_key',
        'transportation',
        'is_anonymous',
        'amount',
        'shirt_size',
        'status',
        'ip_address',
        'user_agent',
    ];
}
