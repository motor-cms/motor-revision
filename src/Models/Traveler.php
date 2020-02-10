<?php

namespace Motor\Revision\Models;

use Illuminate\Database\Eloquent\Model;
use Motor\Core\Traits\Filterable;
use Motor\Core\Traits\Searchable;

//use Culpa\Traits\Blameable;
//use Culpa\Traits\CreatedBy;
//use Culpa\Traits\DeletedBy;
//use Culpa\Traits\UpdatedBy;

class Traveler extends Model
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
    protected $searchableColumns = [
    ];

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

    public function airport()
    {
        return $this->belongsTo(Airport::class);
    }

    public function shuttle()
    {
        return $this->belongsTo(Shuttle::class);
    }
}
