<?php

namespace Motor\Revision\Services;

use Motor\Admin\Services\BaseService;
use Motor\Revision\Models\Ride;

/**
 * Class RideService
 *
 * @package Motor\Revision\Services
 */
class RideService extends BaseService
{
    protected string $model = Ride::class;
}
