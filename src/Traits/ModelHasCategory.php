<?php

namespace Corals\Utility\Category\Traits;

use Corals\Utility\Category\Models\Category;
use Corals\Utility\Category\Models\ModelOption;
use Illuminate\Database\Eloquent\Model;

trait ModelHasCategory
{
    public static function bootModelHasCategory()
    {
        static::deleted(function (Model $deletedModel) {
            $deletedModel->categories()->detach();
        });
    }

    public function categories()
    {
        return $this->morphToMany(
            Category::class,
            'model',
            'utility_model_has_category',
            'model_id',
            'category_id'
        );
    }

    public function activeCategories()
    {
        return $this->categories()->where('utility_categories.status', 'active');
    }

    public function options()
    {
        return $this->morphMany(
            ModelOption::class,
            'model'
        )->groupBy('attribute_id');
    }

    public function options_all()
    {
        return $this->morphMany(
            ModelOption::class,
            'model'
        );
    }
}
