<?php

namespace Motor\Revision\Models;

use Illuminate\Database\Eloquent\Model;
use Kra8\Snowflake\HasShortflakePrimary;
use Motor\Core\Traits\Filterable;
use Motor\Core\Traits\Searchable;

class Hotel extends Model
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
