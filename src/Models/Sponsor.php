<?php

namespace Motor\Revision\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Motor\Core\Traits\Filterable;
use Motor\Core\Traits\Searchable;
use Motor\Media\Models\FileAssociation;

class Sponsor extends Model
{
    use Searchable;
    use Filterable;
    use HasUuids;

    /**
     * Searchable columns for the searchable trait
     *
     * @var array
     */
    protected $searchableColumns = [
        'name',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'url',
        'level',
        'sort_position',
        'is_active',
        'text',
    ];

    /**
     * @return MorphMany
     */
    public function file_associations()
    {
        return $this->morphMany(FileAssociation::class, 'model');
    }
}
