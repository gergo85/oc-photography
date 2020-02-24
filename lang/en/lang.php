<?php

return [
    'plugin' => [
        'name' => 'Photography',
        'description' => 'Manage your photos and equipment easily.',
        'author' => 'Gergő Szabó'
    ],
    'menu' => [
        'photos' => 'Photos',
        'categories' => 'Categories',
        'equipment' => 'Equipment',
        'statistics' => 'Statistics'
    ],
    'title' => [
        'photos' => 'photo',
        'categories' => 'category',
        'equipment' => 'equipment'
    ],
    'new' => [
        'photos' => 'New photo',
        'categories' => 'New category',
        'equipment' => 'New equipment'
    ],
    'form' => [
        // General
        'id' => 'ID',
        'name' => 'Name',
        'slug' => 'Slug',
        'summary' => 'Summary',
        'content' => 'Content',
        'image' => 'Image',
        'status' => 'Status',
        'status_active' => 'Active',
        'status_inactive' => 'Inactive',
        'featured' => 'Featured',
        'yes' => 'Yes',
        'no' => 'No',
        'sort_order' => 'Sort order',
        'created' => 'Created at',
        'updated' => 'Updated at',
        // Photos
        'more' => 'More',
        'sensor_size' => 'Sensor size',
        'exif_date' => 'Make at',
        'exif_model' => 'Camera',
        'exif_aperture' => 'Aperture',
        'exif_exposure' => 'Exposure',
        'exif_focal' => 'Focal length',
        'exif_focal_ff' => 'Focal (35mm)',
        'exif_iso' => 'ISO',
        'exif_flash' => 'Flash',
        'exif_ratio' => 'Ratio',
        'exif_width' => 'Width',
        'exif_height' => 'Height',
        'exif_orientation' => 'Orientation',
        'exif_orientation_l' => 'Landscape',
        'exif_orientation_p' => 'Portrait',
        'exif_orientation_c' => 'Cube',
        'filesize' => 'Filesize',
        // Equipment
        'brand' => 'Brand',
        'purchased' => 'Purchased',
        'comment' => 'Comment',
        'manual' => 'Manual',
        'price' => 'Purchase price',
        'org_price' => 'Original price',
        'type' => 'Type',
        'type_camera' => 'Camera',
        'type_objective' => 'Objective',
        'type_filter' => 'Filter',
        'type_flash' => 'Flash',
        'type_case' => 'Case',
        'type_stand' => 'Stand',
        'type_other' => 'Other'
    ],
    'sensor_size' => [
        'none' => '-- select --',
        'mf' => 'Medium Format',
        'ff' => 'Full Frame',
        'apsh' => 'APS-C',
        'apsc' => 'APS-H',
        'm43' => 'm4/3',
        '10' => '1"',
        '16' => '1/1.6"',
        '23' => '1/2.3"',
        'other' => 'Other'
    ],
    'button' => [
        'activate' => 'Activate',
        'inactivate' => 'Inactivate',
        'active' => 'Active',
        'inactive' => 'Inactive',
        'remove' => 'Removed',
        'reorder' => 'Reorder',
        'previous' => 'Previous',
        'next' => 'Next',
        'return' => 'Return'
    ],
    'flash' => [
        'activate' => 'Successfully activated those items.',
        'inactivate' => 'Successfully inactivated those items.',
        'delete' => 'Do you want to delete this items?',
        'remove' => 'Successfully removed those items.'
    ],
    'statistics' => [
        'no_photo' => 'To see statistics, upload a photo first.',
        'photos' => 'Photos',
        'max' => 'Max',
        'min' => 'Min',
        'avg' => 'Avg'
    ],
    'widget' => [
        'summary' => 'Photography - Summary',
        'show_photos' => 'Show photos',
        'show_categories' => 'Show categories',
        'show_equipment' => 'Show equipment'
    ],
    'permission' => [
        'photos' => 'Manage photos',
        'categories' => 'Manage categories',
        'equipment' => 'Manage equipment',
        'statistics' => 'View statistics'
    ]
];
