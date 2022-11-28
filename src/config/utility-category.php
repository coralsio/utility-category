<?php

return [
    'models' => [
        'category' => [
            'presenter' => \Corals\Modules\Utility\Category\Transformers\CategoryPresenter::class,
            'resource_url' => 'utilities/categories',
            'default_image' => 'assets/corals/images/default_product_image.png',
            'translatable' => ['name'],
        ],
        'attribute' => [
            'presenter' => \Corals\Modules\Utility\Category\Transformers\AttributePresenter::class,
            'resource_url' => 'utilities/attributes',
        ],
    ],
];
