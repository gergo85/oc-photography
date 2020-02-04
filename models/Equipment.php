<?php namespace Indikator\Photography\Models;

use Model;

class Equipment extends Model
{
    use \October\Rain\Database\Traits\Sortable;
    use \October\Rain\Database\Traits\Validation;

    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    protected $table = 'indikator_photography_equipment';

    public $rules = [
        'name'     => ['required', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'unique:indikator_photography_equipment'],
        'type'     => 'required|between:1,7|numeric',
        'status'   => 'required|between:1,2|numeric',
        'featured' => 'required|between:1,2|numeric'
    ];

    public $translatable = [
        'name',
        'content'
    ];
}
