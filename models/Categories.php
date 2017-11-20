<?php namespace Indikator\Photography\Models;

use Model;

class Categories extends Model
{
    use \October\Rain\Database\Traits\Sluggable;
    use \October\Rain\Database\Traits\Sortable;
    use \October\Rain\Database\Traits\Validation;

    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    protected $table = 'indikator_photography_categories';

    public $rules = [
        'name'     => 'required',
        'slug'     => ['required', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'unique:indikator_photography_categories'],
        'status'   => 'required|between:1,2|numeric',
        'featured' => 'required|between:1,2|numeric'
    ];

    protected $slugs = [
        'slug' => 'name'
    ];

    public $translatable = [
        'name',
        ['slug', 'index' => true],
        'summary',
        'content'
    ];
}
