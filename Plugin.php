<?php namespace Indikator\Photography;

use System\Classes\PluginBase;
use Backend;
use Lang;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'indikator.photography::lang.plugin.name',
            'description' => 'indikator.photography::lang.plugin.description',
            'author'      => 'indikator.photography::lang.plugin.author',
            'icon'        => 'icon-picture-o',
            'homepage'    => 'http://www.indikator.hu'
        ];
    }

    public function registerNavigation()
    {
        return [
            'photography' => [
                'label'       => 'indikator.photography::lang.plugin.name',
                'url'         => Backend::url('indikator/photography/photos'),
                'icon'        => 'icon-camera',
                'permissions' => ['indikator.photography.*'],
                'order'       => 500,

                'sideMenu' => [
                    'photos' => [
                        'label'       => 'indikator.photography::lang.menu.photos',
                        'url'         => Backend::url('indikator/photography/photos'),
                        'icon'        => 'icon-picture-o',
                        'permissions' => ['indikator.photography.photos']
                    ],
                    'categories' => [
                        'label'       => 'indikator.photography::lang.menu.categories',
                        'url'         => Backend::url('indikator/photography/categories'),
                        'icon'        => 'icon-tags',
                        'permissions' => ['indikator.photography.categories']
                    ],
                    'equipment' => [
                        'label'       => 'indikator.photography::lang.menu.equipment',
                        'url'         => Backend::url('indikator/photography/equipment'),
                        'icon'        => 'icon-suitcase',
                        'permissions' => ['indikator.photography.equipment']
                    ]
                ]
            ]
        ];
    }

    public function registerReportWidgets()
    {
        return [
            'Indikator\Photography\ReportWidgets\Summary' => [
                'label'   => 'indikator.photography::lang.widget.summary',
                'context' => 'dashboard'
            ]
        ];
    }

    public function registerPermissions()
    {
        return [
            'indikator.photography.photos' => [
                'tab'   => 'indikator.photography::lang.menu.photography',
                'label' => 'indikator.photography::lang.permission.photos'
            ],
            'indikator.photography.categories' => [
                'tab'   => 'indikator.photography::lang.menu.photography',
                'label' => 'indikator.photography::lang.permission.categories'
            ],
            'indikator.photography.equipment' => [
                'tab'   => 'indikator.photography::lang.menu.photography',
                'label' => 'indikator.photography::lang.permission.equipment'
            ]
        ];
    }

    public function registerListColumnTypes()
    {
        return [
            'photo_status' => function($value) {
                $text = [
                    1 => 'active',
                    2 => 'inactive'
                ];

                $class = [
                    1 => 'text-info',
                    2 => 'text-danger'
                ];

                return '<span class="oc-icon-circle '.$class[$value].'">'.Lang::get('indikator.photography::lang.form.status_'.$text[$value]).'</span>';
            },
            'photo_featured' => function($value) {
                $text = [
                    1 => 'true',
                    2 => 'false'
                ];

                $class = [
                    1 => 'text-info',
                    2 => ''
                ];

                return '<span class="oc-icon-circle '.$class[$value].'">'.Lang::get('backend::lang.list.column_switch_'.$text[$value]).'</span>';
            }
        ];
    }
}
