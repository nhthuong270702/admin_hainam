<?php

namespace App\Repositories;

use App\Models\ExportProduct;
use App\Modules\Repositories\BaseRepository;

class ExportProductRepository extends BaseRepository
{
    /**
     * Lifetime of the cache.
     *
     * @var int
     */
    protected $cacheMinutes = 10;

    /**
     * Flush the cache after create/update/delete events.
     *
     * @var bool
     */
    protected $eventFlushCache = false;

    /**
     * Specify Model class name
     *
     * @return string
     */
    protected $model = ExportProduct::class;
}
