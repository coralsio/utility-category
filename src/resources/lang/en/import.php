<?php

return [
    'labels' => [
        'import' => '<i class="fa fa-th fa-th"></i> Import',
        'download_sample' => '<i class="fa fa-download fa-th"></i> Download Import Sample',
        'column' => 'Column',
        'description' => 'Description',
        'column_description' => 'Import columns description',
        'file' => 'Import File (csv)',
        'upload_file' => '<i class="fa fa-upload fa-th"></i> Upload',
    ],
    'messages' => [
        'file_uploaded' => 'File has been uploaded successfully and a job dispatched to handle the import process.'
    ],
    'exceptions' => [
        'invalid_headers' => 'Invalid import file columns. Please check the sample import file.',
        'path_not_exist' => 'path not exist.',
    ],
    'category-headers' => [
        'name' => 'category name',
        'slug' => 'category slug',
        'status' => 'category status',
        'parent_id' => 'Parent Category',
        'module' => 'module',
        'is_featured' => 'category is featured',
        'category_attributes' => 'category attributes',
        'description' => 'category description',
        'thumbnail_link' => 'categroy thumbnail link'
    ],
];
