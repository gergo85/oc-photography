<?php

return [
    'plugin' => [
        'name' => 'Fotózás',
        'description' => 'Fényképek és fotós felszerelések menedzselése.',
        'author' => 'Szabó Gergő'
    ],
    'menu' => [
        'photos' => 'Fotók',
        'categories' => 'Kategóriák',
        'equipment' => 'Felszerelés',
        'statistics' => 'Statisztika'
    ],
    'title' => [
        'photos' => 'fotó',
        'categories' => 'kategória',
        'equipment' => 'felszerelés'
    ],
    'new' => [
        'photos' => 'Új fotó',
        'categories' => 'Új kategória',
        'equipment' => 'Új felszerelés'
    ],
    'form' => [
        // Általános
        'id' => 'ID',
        'name' => 'Név',
        'slug' => 'Webcím',
        'summary' => 'Összegzés',
        'content' => 'Tartalom',
        'image' => 'Fotó',
        'status' => 'Státusz',
        'status_active' => 'Aktív',
        'status_inactive' => 'Inaktív',
        'featured' => 'Kiemelt',
        'yes' => 'Igen',
        'no' => 'Nem',
        'sort_order' => 'Sorrend',
        'created' => 'Létrehozva',
        'updated' => 'Módosítva',
        // Fotók
        'more' => 'Továbbiak',
        'sensor_size' => 'Szenzor mérete',
        'exif_date' => 'Elkészítve',
        'exif_model' => 'Fényképezőgép',
        'exif_aperture' => 'Rekesz',
        'exif_exposure' => 'Záridő',
        'exif_focal' => 'Fókusz',
        'exif_focal_ff' => 'Fókusz (35mm)',
        'exif_iso' => 'ISO',
        'exif_flash' => 'Vaku',
        'exif_ratio' => 'Képarány',
        'exif_width' => 'Szélesség',
        'exif_height' => 'Magasság',
        'exif_orientation' => 'Tájolás',
        'exif_orientation_l' => 'Fekvő',
        'exif_orientation_p' => 'Álló',
        'exif_orientation_c' => 'Négyzet',
        'filesize' => 'Fájlméret',
        // Felszerelés
        'brand' => 'Márka',
        'purchased' => 'Megvásárolva',
        'comment' => 'Megjegyzés',
        'manual' => 'Útmutató',
        'price' => 'Vételár',
        'org_price' => 'Eredeti ár',
        'type' => 'Típus',
        'type_camera' => 'Kamera',
        'type_objective' => 'Objektív',
        'type_filter' => 'Szűrő',
        'type_flash' => 'Vaku',
        'type_case' => 'Táska',
        'type_stand' => 'Állvány',
        'type_other' => 'Egyéb'
    ],
    'sensor_size' => [
        'none' => '-- válasszon --',
        'mf' => 'Közép formátum',
        'ff' => 'Full Frame',
        'apsh' => 'APS-C',
        'apsc' => 'APS-H',
        'm43' => 'm4/3',
        '10' => '1"',
        '16' => '1/1.6"',
        '23' => '1/2.3"',
        'other' => 'Egyéb'
    ],
    'button' => [
        'activate' => 'Aktíválás',
        'deactivate' => 'Deaktiválás',
        'active' => 'Aktív',
        'inactive' => 'Inaktív',
        'remove' => 'Eltávolítás',
        'reorder' => 'Sorrend',
        'previous' => 'Előző',
        'next' => 'Következő',
        'return' => 'Vissza'
    ],
    'flash' => [
        'activate' => 'A tételek sikeresen aktiválva lettek.',
        'deactivate' => 'A tételek sikeresen deaktiválva lettek.',
        'delete' => 'Valóban törölni akarja a tételeket?',
        'remove' => 'A tételek sikeresen eltávolításra kerültek.'
    ],
    'statistics' => [
        'no_photo' => 'Statisztika megtekintéséhez előbb töltsön fel fotót!',
        'photos' => 'Fotó',
        'max' => 'Max.',
        'min' => 'Min.',
        'avg' => 'Átlag'
    ],
    'widget' => [
        'summary' => 'Fotózás - Összegzés',
        'show_photos' => 'Fotók mutatása',
        'show_categories' => 'Kategóriák mutatása',
        'show_equipment' => 'Felszerelés mutatása'
    ],
    'permission' => [
        'photos' => 'Fotók kezelése',
        'categories' => 'Kategóriák kezelése',
        'equipment' => 'Felszerelés kezelése',
        'statistics' => 'Statisztika megtekintése'
    ]
];
