<?php

namespace Motor\Revision\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Motor\Core\Traits\Filterable;
use Motor\Core\Traits\Searchable;

class Ride extends Model
{
    use Searchable;
    use Filterable;
    use HasUuids;

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
