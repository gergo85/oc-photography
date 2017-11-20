<?php namespace Indikator\Photography\ReportWidgets;

use Backend\Classes\ReportWidgetBase;
use Exception;

class Summary extends ReportWidgetBase
{
    public function render()
    {
        try {
            $this->loadData();
        }
        catch (Exception $ex) {
            $this->vars['error'] = $ex->getMessage();
        }

        return $this->makePartial('widget');
    }

    public function defineProperties()
    {
        return [
            'title' => [
                'title'             => 'backend::lang.dashboard.widget_title_label',
                'default'           => 'indikator.photography::lang.widget.summary',
                'type'              => 'string',
                'validationPattern' => '^.+$',
                'validationMessage' => 'backend::lang.dashboard.widget_title_error'
            ],
            'photos' => [
                'title'             => 'indikator.photography::lang.widget.show_photos',
                'default'           => true,
                'type'              => 'checkbox'
            ],
            'categories' => [
                'title'             => 'indikator.photography::lang.widget.show_categories',
                'default'           => true,
                'type'              => 'checkbox'
            ]
        ];
    }

    protected function loadData()
    {
        $this->vars['photos']     = \Indikator\Photography\Models\Photos::count();
        $this->vars['categories'] = \Indikator\Photography\Models\Categories::count();
    }
}
