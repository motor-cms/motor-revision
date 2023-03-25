<?php

namespace Motor\Revision\Models;

use Kra8\Snowflake\HasShortflakePrimary;
use Illuminate\Database\Eloquent\Model;
use Motor\Core\Traits\Filterable;
use Motor\Core\Traits\Searchable;

class Hotel extends Model
{
    use Searchable;
    use Filterable;
    use HasShortflakePrimary;

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
        'short',
        'name',
        'description',
        'address',
        'email',
        'website',
        'latitude',
        'longitude',
        'rating',
        'is_active',
    ];
}
