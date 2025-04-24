<?php

namespace Motor\Revision\Models;

use Illuminate\Database\Eloquent\Model;
use Kra8\Snowflake\HasShortflakePrimary;
use Motor\Core\Traits\Filterable;
use Motor\Core\Traits\Searchable;

class Ride extends Model
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
        'direction',
        'type',
        'means_of_transportation',
        'name',
        'email',
        'country',
        'route',
        'ip_address',
        'user_agent',
    ];
}
