<?php namespace Indikator\Photography;

use System\Classes\PluginBase;
use Backend;
use Lang;
use Indikator\Photography\Models\Photos as PhotosModel;
use Indikator\Photography\Controllers\Photos as PhotosController;
use Indikator\Photography\Models\Categories;
use Indikator\Photography\Models\Equipment as EquipmentModel;
use Indikator\Photography\Controllers\Equipment as EquipmentController;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'indikator.photography::lang.plugin.name',
            'description' => 'indikator.photography::lang.plugin.description',
            'author'      => 'indikator.photography::lang.plugin.author',
            'icon'        => 'icon-picture-o',
            'homepage'    => 'https://github.com/gergo85/oc-photography'
        ];
    }

    public function registerNavigation()
    {
        return [
            'photography' => [
                'label'       => 'indikator.photography::lang.plugin.name',
                'url'         => Backend::url('indikator/photography/photos'),
                'icon'        => 'icon-camera',
                'iconSvg'     => 'plugins/indikator/photography/assets/images/photography-icon.svg',
                'permissions' => ['indikator.photography.*'],
                'order'       => 360,

                'sideMenu' => [
                    'photos' => [
                        'label'       => 'indikator.photography::lang.menu.photos',
                        'url'         => Backend::url('indikator/photography/photos'),
                        'icon'        => 'icon-picture-o',
                        'permissions' => ['indikator.photography.photos'],
                        'order'       => 100
                    ],
                    'categories' => [
                        'label'       => 'indikator.photography::lang.menu.categories',
                        'url'         => Backend::url('indikator/photography/categories'),
                        'icon'        => 'icon-tags',
                        'permissions' => ['indikator.photography.categories'],
                        'order'       => 200
                    ],
                    'equipment' => [
                        'label'       => 'indikator.photography::lang.menu.equipment',
                        'url'         => Backend::url('indikator/photography/equipment'),
                        'icon'        => 'icon-suitcase',
                        'permissions' => ['indikator.photography.equipment'],
                        'order'       => 300
                    ],
                    'statistics' => [
                        'label'       => 'indikator.photography::lang.menu.statistics',
                        'url'         => Backend::url('indikator/photography/statistics'),
                        'icon'        => 'icon-pie-chart',
                        'permissions' => ['indikator.photography.statistics'],
                        'order'       => 400
                    ],
                ]
            ]
        ];
    }

    public function registerReportWidgets()
    {
        return [
            'Indikator\Photography\ReportWidgets\Summary' => [
                'label'       => 'indikator.photography::lang.widget.summary',
                'context'     => 'dashboard',
                'permissions' => ['indikator.photography.statistics']
            ]
        ];
    }

    public function registerPermissions()
    {
        return [
            'indikator.photography.photos' => [
                'tab'   => 'indikator.photography::lang.plugin.name',
                'label' => 'indikator.photography::lang.permission.photos',
                'order' => 100,
                'roles' => ['publisher']
            ],
            'indikator.photography.categories' => [
                'tab'   => 'indikator.photography::lang.plugin.name',
                'label' => 'indikator.photography::lang.permission.categories',
                'order' => 200,
                'roles' => ['publisher']
            ],
            'indikator.photography.equipment' => [
                'tab'   => 'indikator.photography::lang.plugin.name',
                'label' => 'indikator.photography::lang.permission.equipment',
                'order' => 300,
                'roles' => ['publisher']
            ],
            'indikator.photography.statistics' => [
                'tab'   => 'indikator.photography::lang.plugin.name',
                'label' => 'indikator.photography::lang.permission.statistics',
                'order' => 400,
                'roles' => ['publisher']
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

    public function boot()
    {
        PhotosController::extendFormFields(function($form, $model, $context)
        {
            if (!$model instanceof PhotosModel || Categories::count() > 0) {
                return;
            }

            $form->removeField('category');
        });

        PhotosController::extendListColumns(function($list, $model)
        {
            if (!$model instanceof PhotosModel || Categories::count() > 0) {
                return;
            }

            $list->removeColumn('category');
        });

        PhotosController::extendListFilterScopes(function($filter)
        {
            if (Categories::count() == 0) {
                $filter->removeScope('category');
            }
        });

        EquipmentController::extendListColumns(function($list, $model)
        {
            if (!$model instanceof EquipmentModel) {
                return;
            }

            if (EquipmentModel::where('brand', '!=', '')->count() == 0) {
                $list->removeColumn('brand');
            }

            if (EquipmentModel::where('purchased', '!=', '')->count() == 0) {
                $list->removeColumn('purchased');
            }

            if (EquipmentModel::where('price', '!=', '')->count() == 0) {
                $list->removeColumn('price');
            }

            if (EquipmentModel::where('org_price', '!=', '')->count() == 0) {
                $list->removeColumn('org_price');
            }

            if (EquipmentModel::where('comment', '!=', '')->count() == 0) {
                $list->removeColumn('comment');
            }
        });
    }
}
