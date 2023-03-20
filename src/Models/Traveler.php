<?php

namespace Motor\Revision\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Motor\Core\Traits\Filterable;
use Motor\Core\Traits\Searchable;


class Traveler extends Model
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
        'name',
        'email',
        'mobile_phone',
        'number_of_people',
        'flight_number',
        'flight_time',
        'direction',
        'shuttle_id',
        'airport_id',
        'ip_address',
        'user_agent',
        'info_sent_at',
        'confirmation_sent_at',
    ];

    public function scopeToPartyWithoutShuttle($query)
    {
        return $query->where('direction', 'party')
                     ->whereNull('shuttle_id')
                     ->orderBy('flight_time', 'ASC');
    }

    public function scopeToAirportWithoutShuttle($query)
    {
        return $query->where('direction', 'airport')
                     ->whereNull('shuttle_id')
                     ->orderBy('flight_time', 'ASC');
    }

    public function scopeToPartyWithShuttle($query)
    {
        return $query->where('direction', 'party')
                     ->whereNotNull('shuttle_id')
                     ->orderBy('shuttle_id', 'ASC');
    }

    public function scopeToAirportWithShuttle($query)
    {
        return $query->where('direction', 'airport')
                     ->whereNotNull('shuttle_id')
                     ->orderBy('shuttle_id', 'ASC');
    }

    public function airport()
    {
        return $this->belongsTo(Airport::class);
    }

    public function shuttle()
    {
        return $this->belongsTo(Shuttle::class);
    }
}
