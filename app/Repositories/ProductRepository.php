<?php

namespace App\Repositories;

use App\Models\Product;
use App\Modules\Repositories\BaseRepository;

class ProductRepository extends BaseRepository
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
    protected $model = Product::class;
}
