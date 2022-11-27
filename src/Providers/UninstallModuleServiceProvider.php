<?php

namespace Corals\Modules\Utility\Category\Providers;

use Corals\Foundation\Providers\BaseUninstallModuleServiceProvider;
use Corals\Modules\Utility\Category\database\migrations\CreateCategoryAttributeTables;
use Corals\Modules\Utility\Category\database\seeds\UtilityCategoryDatabaseSeeder;

class UninstallModuleServiceProvider extends BaseUninstallModuleServiceProvider
{
    protected $migrations = [
        CreateCategoryAttributeTables::class,
    ];

    protected function providerBooted()
    {
        $this->dropSchema();

        $utilityCategoryDatabaseSeeder = new UtilityCategoryDatabaseSeeder();

        $utilityCategoryDatabaseSeeder->rollback();
    }
}
