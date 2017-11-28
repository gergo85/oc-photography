<?php

return [
    'plugin' => [
        'name' => 'Photography',
        'description' => 'Manage your photos easily.',
        'author' => 'Gergő Szabó'
    ],
    'menu' => [
        'photos' => 'Photos',
        'categories' => 'Categories',
        'equipment' => 'Equipment'
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
        'exif_date' => 'Make at',
        'exif_model' => 'Camera',
        'exif_aperture' => 'Aperture',
        'exif_exposure' => 'Exposure',
        'exif_focal' => 'Focal length',
        'exif_iso' => 'ISO',
        'exif_flash' => 'Flash',
        'exif_ratio' => 'Ratio',
        'exif_width' => 'Width',
        'exif_height' => 'Height',
        'exif_orientation' => 'Orientation',
        'exif_orientation_l' => 'Landscape',
        'exif_orientation_p' => 'Portrait',
        'exif_orientation_c' => 'Cube',
        // Equipment
        'brand' => 'Brand',
        'purchased' => 'Purchased',
        'comment' => 'Comment',
        'manual' => 'Manual',
        'price' => 'Purchase price',
        'org_price' => 'Original price',
        'type' => 'Type',
        'type_camera' => 'Camera',
        'type_lens' => 'Lens',
        'type_flash' => 'Flash',
        'type_case' => 'Case',
        'type_other' => 'Other'
    ],
    'button' => [
        'activate' => 'Activate',
        'deactivate' => 'Deactivate',
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
        'deactivate' => 'Successfully deactivated those items.',
        'delete' => 'Do you really want to delete this items?',
        'remove' => 'Successfully removed those items.'
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
        'equipment' => 'Manage equipment'
    ]
];
