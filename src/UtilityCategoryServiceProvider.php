<?php

namespace Corals\Modules\Utility\Category;

use Corals\Foundation\Providers\BasePackageServiceProvider;
use Corals\Modules\Utility\Category\Facades\Category;
use Corals\Modules\Utility\Category\Models\Attribute;
use Corals\Modules\Utility\Category\Models\AttributeOption;
use Corals\Modules\Utility\Category\Models\Category as CargoryModel;
use Corals\Modules\Utility\Category\Models\Category as CategoryModel;
use Corals\Modules\Utility\Category\Providers\UtilityAuthServiceProvider;
use Corals\Modules\Utility\Category\Providers\UtilityRouteServiceProvider;
use Corals\Modules\Utility\Models\Category\ModelOption;
use Corals\Settings\Facades\Modules;
use Corals\Settings\Facades\Settings;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\AliasLoader;

class UtilityCategoryServiceProvider extends BasePackageServiceProvider
{
    /**
     * @var
     */
    protected $packageCode = 'corals-utility-category';

    public function bootPackage()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'utility-category');
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'utility-category');

        $this->mergeConfigFrom(
            __DIR__ . '/config/utility-category.php',
            'utility-category'
        );
        $this->publishes([
            __DIR__ . '/config/utility-category.php' => config_path('utility-category.php'),
            __DIR__ . '/resources/views' => resource_path('resources/views/vendor/utility-category'),
        ]);

        $this->registerMorphMaps();
        $this->registerCustomFieldsModels();
    }

    public function registerPackage()
    {
        $this->app->register(UtilityAuthServiceProvider::class);
        $this->app->register(UtilityRouteServiceProvider::class);

        $this->app->booted(function () {
            $loader = AliasLoader::getInstance();
            $loader->alias('Category', Category::class);
        });
    }

    protected function registerMorphMaps()
    {
        Relation::morphMap([
            'UtilityAttribute' => Attribute::class,
            'UtilityAttributeOption' => AttributeOption::class,
            'UtilityCategory' => CargoryModel::class,
            'UtilityModelOption' => ModelOption::class,
        ]);
    }

    protected function registerCustomFieldsModels()
    {
        Settings::addCustomFieldModel(CategoryModel::class, 'Category (Utility)');
    }

    public function registerModulesPackages()
    {
        Modules::addModulesPackages('corals/utility-category');
    }
}
