<?php

namespace Motor\Revision\Models;

use Kra8\Snowflake\HasSnowflakePrimary;
use Illuminate\Database\Eloquent\Model;
use Motor\Core\Traits\Filterable;
use Motor\Core\Traits\Searchable;

class Ride extends Model
{
    use Searchable;
    use Filterable;
    use HasSnowflakePrimary;

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
