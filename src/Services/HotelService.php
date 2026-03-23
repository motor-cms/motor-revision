<?php

namespace Motor\Revision\Services;

use Motor\Admin\Services\BaseService;
use Motor\Revision\Models\Hotel;

/**
 * Class HotelService
 *
 * @package Motor\Revision\Services
 */
class HotelService extends BaseService
{
    protected string $model = Hotel::class;
}
