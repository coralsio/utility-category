<?php

namespace Corals\Utility\Category\Transformers;

use Corals\Foundation\Transformers\BaseTransformer;
use Corals\Utility\Category\Models\Category;

class CategoryTransformer extends BaseTransformer
{
    public function __construct($extras = [])
    {
        $this->resource_url = config('utility-category.models.category.resource_url');

        parent::__construct($extras);
    }

    /**
     * @param Category $category
     * @return array
     * @throws \Throwable
     */
    public function transform(Category $category)
    {
        $transformedArray = [
            'id' => $category->id,
            'checkbox' => $this->generateCheckboxElement($category),
            'name' => $category->name . ($category->is_featured ? '&nbsp;<i class="fa fa-star text-warning" title="Featured"></i>' : ''),
            'slug' => $category->slug,
            'thumbnail' => $category->thumbnail,
            'parent_id' => optional($category->parent)->name ?? '-',
            'status' => formatStatusAsLabels($category->status),
            'created_at' => format_date($category->created_at),
            'updated_at' => format_date($category->updated_at),
            'action' => $this->actions($category),
        ];

        return parent::transformResponse($transformedArray);
    }
}
