<?php

namespace Motor\Revision\Models;

use Illuminate\Database\Eloquent\Model;
use Motor\Core\Traits\Filterable;
use Motor\Core\Traits\Searchable;

//use Culpa\Traits\Blameable;
//use Culpa\Traits\CreatedBy;
//use Culpa\Traits\DeletedBy;
//use Culpa\Traits\UpdatedBy;

class Shuttle extends Model
{
    use Searchable;
    use Filterable;

//    use Blameable, CreatedBy, UpdatedBy, DeletedBy;

    /**
     * Columns for the Blameable trait
     *
     * @var array
     */
//    protected $blameable = array('created', 'updated', 'deleted');

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
        'airport_id',
        'name',
        'direction',
        'departs_at',
        'arrives_at',
        'seats',
        'travel_time',
        'price',
        'is_active',
    ];

    public function scopeConfirmedToParty($query)
    {
        return $query->where('direction', 'party')
                     ->where('is_active', true)
                     ->orderBy('departs_at', 'ASC');
    }

    public function scopeConfirmedToAirport($query)
    {
        return $query->where('direction', 'airport')
                     ->where('is_active', true)
                     ->orderBy('departs_at', 'ASC');
    }

    public function airport()
    {
        return $this->belongsTo(Airport::class);
    }

    public function travelers()
    {
        return $this->hasMany(Traveler::class);
    }

    public function getSeatsTakenAttribute()
    {
        return $this->travelers()
                    ->sum('number_of_people');
    }
}
