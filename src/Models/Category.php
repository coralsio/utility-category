<?php

namespace Corals\Utility\Category\Models;

use Corals\Foundation\Models\BaseModel;
use Corals\Foundation\Traits\Node\SimpleNode;
use Corals\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends BaseModel implements HasMedia
{
    use PresentableTrait;
    use LogsActivity;
    use InteractsWithMedia ;
    use SimpleNode;

    protected $table = 'utility_categories';

    protected $casts = [
        'is_featured' => 'boolean',
        'properties' => 'json',
    ];

    public $mediaCollectionName = 'utility-category-thumbnail';
    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'utility-category.models.category';

    protected $guarded = ['id'];

    public function categoryAttributes()
    {
        return $this->belongsToMany(Attribute::class, 'utility_category_attributes', 'category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('utility_categories.status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('utility_categories.is_featured', true);
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = \Str::slug($value);
    }

    public function renderCategoryOptions($product, $attributes = [])
    {
        $fields = $this->categoryAttributes;

        $input = '';

        foreach ($fields as $field) {
            $input .= \Corals\Utility\Category\Facades\Category::renderAttribute($field, $product, $attributes);
        }

        return $input;
    }
}
