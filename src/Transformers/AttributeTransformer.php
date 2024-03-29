<?php

namespace Corals\Utility\Category\Transformers;

use Corals\Foundation\Transformers\BaseTransformer;
use Corals\Utility\Category\Models\Attribute;

class AttributeTransformer extends BaseTransformer
{
    public function __construct($extras = [])
    {
        $this->resource_url = config('utility-category.models.attribute.resource_url');

        parent::__construct($extras);
    }

    /**
     * @param Attribute $attribute
     * @return array
     * @throws \Throwable
     */
    public function transform(Attribute $attribute)
    {
        $transformedArray = [
            'id' => $attribute->id,
            'checkbox' => $this->generateCheckboxElement($attribute),
            'type' => $attribute->type,
            'label' => $attribute->label,
            'required' => $attribute->required ? '<i class="fa fa-check text-success"></i>' : '-',
            'use_as_filter' => $attribute->use_as_filter ? '<i class="fa fa-check text-success"></i>' : '-',
            'created_at' => format_date($attribute->created_at),
            'updated_at' => format_date($attribute->updated_at),
            'action' => $this->actions($attribute),
        ];

        return parent::transformResponse($transformedArray);
    }
}
