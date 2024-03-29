<?php

namespace Corals\Utility\Category\Models;

use Corals\Foundation\Models\BaseModel;
use Corals\Foundation\Traits\ModelPropertiesTrait;
use Corals\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Attribute extends BaseModel implements HasMedia
{
    use PresentableTrait;
    use LogsActivity;
    use ModelPropertiesTrait;
    use InteractsWithMedia ;

    protected $table = 'utility_attributes';

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'utility-category.models.attribute';

    protected $casts = [
        'use_as_filter' => 'boolean',
        'properties' => 'json',
    ];

    protected $guarded = ['id'];

    public $mediaCollectionName = 'utility-attribute-thumbnail';

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'utility_category_attributes');
    }

    public function options()
    {
        return $this->hasMany(AttributeOption::class)->orderBy('option_order');
    }
}
