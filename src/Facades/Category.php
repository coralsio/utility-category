<?php

namespace Corals\Modules\Utility\Category\Facades;

use Illuminate\Support\Facades\Facade;

class Category extends Facade
{
    /**
     * @return mixed
     */
    protected static function getFacadeAccessor()
    {
        return \Corals\Modules\Utility\Category\Classes\CategoryManager::class;
    }
}
