<?php
//Category
Breadcrumbs::register('utility_categories', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('Utility::module.category.title'), url(config('utility.models.category.resource_url')));
});
Breadcrumbs::register('utility_category_create_edit', function ($breadcrumbs) {
    $breadcrumbs->parent('utility_categories');
    $breadcrumbs->push(view()->shared('title_singular'));
});
//attribute
Breadcrumbs::register('utility_attributes', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('Utility::module.attribute.title_singular'), url(config('utility.models.attribute.resource_url')));
});

Breadcrumbs::register('utility_attribute_create_edit', function ($breadcrumbs) {
    $breadcrumbs->parent('utility_attributes');
    $breadcrumbs->push(view()->shared('title_singular'));
});


