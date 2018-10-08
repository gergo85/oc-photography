<?php namespace Indikator\Photography\Models;

use Model;
use Db;

class Photos extends Model
{
    use \October\Rain\Database\Traits\Sluggable;
    use \October\Rain\Database\Traits\Validation;

    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    protected $table = 'indikator_photography_photos';

    public $rules = [
        'name'     => 'required',
        'slug'     => ['required', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'unique:indikator_photography_photos'],
        'status'   => 'required|between:1,2|numeric',
        'featured' => 'required|between:1,2|numeric'
    ];

    public $belongsToMany = [
        'category' => [
            'Indikator\Photography\Models\Categories',
            'table' => 'indikator_photography_relations',
            'order' => 'name'
        ]
    ];

    protected $slugs = [
        'slug' => 'name'
    ];

    public $translatable = [
        'name',
        ['slug', 'index' => true],
        'content'
    ];

    public function scopeFilterCategories($query, $categories)
    {
        return $query->whereHas('category', function($q) use ($categories) {
            $q->whereIn('id', $categories);
        });
    }

    public function beforeSave()
    {
        // Media folder
        $path = base_path().'/storage/app/media';

        // Checks if the photo exists
        if (isset($this->image) && !empty($this->image) && file_exists($path.$this->image)) {
            // Basic data
            $exif_ifd0 = @read_exif_data($path.$this->image, 'IFD0', 0);
            $exif_exif = @read_exif_data($path.$this->image, 'EXIF', 0);

            // Date and time
            if (@array_key_exists('DateTime', $exif_ifd0)) {
                $this->exif_date = $exif_ifd0['DateTime'];
            }
            else {
                $this->exif_date = '-';
            }

            // Camera model
            if (@array_key_exists('Model', $exif_ifd0)) {
                $this->exif_model = $exif_ifd0['Model'];
            }
            else {
                $this->exif_model = '-';
            }

            // Camera brand
            if (@array_key_exists('Make', $exif_ifd0)) {
                if (substr_count($this->exif_model, $exif_ifd0['Make']) == 0) {
                    $this->exif_model = $exif_ifd0['Make'].' '.$this->exif_model;
                }
                else if ($this->exif_model == '-') {
                    $this->exif_model = $exif_ifd0['Make'];
                }
            }

            // Aperture
            if (@array_key_exists('ApertureFNumber', $exif_ifd0['COMPUTED'])) {
                $this->exif_aperture = str_replace('.0', '', $exif_ifd0['COMPUTED']['ApertureFNumber']);
            }
            else {
                $this->exif_aperture = '-';
            }

            // Exposure
            if (@array_key_exists('ExposureTime', $exif_ifd0)) {
                if (substr($exif_ifd0['ExposureTime'], -2) == '/1') {
                    $exif_ifd0['ExposureTime'] = substr($exif_ifd0['ExposureTime'], 0, -2);
                }
                else if (substr($exif_ifd0['ExposureTime'], 0, 3) == '10/') {
                    $exif_ifd0['ExposureTime'] = '1'.substr($exif_ifd0['ExposureTime'], 2, -1);
                }
                $this->exif_exposure = $exif_ifd0['ExposureTime'];
            }
            else {
                $this->exif_exposure = '-';
            }

            // Focal length
            if (@array_key_exists('FocalLength', $exif_exif)) {
                $value = str_replace('/1', '', $exif_exif['FocalLength']);
                if ($value > 800) {
                    $value = round($value / 100);
                }
                $this->exif_focal = $value.' mm';
            }
            else {
                $this->exif_focal = '-';
            }

            // ISO
            if (@array_key_exists('ISOSpeedRatings', $exif_exif)) {
                $this->exif_iso = $exif_exif['ISOSpeedRatings'];
            }
            else {
                $this->exif_iso = '-';
            }

            // Flash
            if (@array_key_exists('Flash', $exif_exif)) {
                $flash = [
                    '0x0' => 0,
                    '0x1' => 1,
                    '0x5' => 1,
                    '0x7' => 1,
                    '0x8' => 0,
                    '0x9' => 1,
                    '0xd' => 1,
                    '0xf' => 1,
                    '0x10' => 0,
                    '0x14' => 0,
                    '0x18' => 0,
                    '0x19' => 1,
                    '0x1d' => 1,
                    '0x1f' => 1,
                    '0x20' => 0,
                    '0x30' => 0,
                ];

                if (isset($flash[dechex($exif_exif['Flash'])])) {
                    $this->exif_flash = 'Yes';
                }
                else {
                    $this->exif_flash = 'No';
                }
            }
            else {
                $this->exif_flash = 'No';
            }

            // Dimension
            $size = getimagesize($path.$this->image);
            $this->exif_width  = $size[0];
            $this->exif_height = $size[1];

            // Orientation
            if ($size[0] > $size[1]) {
                $this->exif_orientation = 'l';
                $photo_ratio = round($size[0] / $size[1], 2);
            }
            else if ($size[0] < $size[1]) {
                $this->exif_orientation = 'p';
                $photo_ratio = round($size[1] / $size[0], 2);
            }
            else {
                $this->exif_orientation = 'c';
                $photo_ratio = 1;
            }

            $this->exif_ratio = $this->getRatio($photo_ratio);

            // Filesize
            $this->filesize = filesize($path.$this->image);
        }
    }

    public function getCategories()
    {
        if ($this->_categories === null) {
            $this->_categories = [];
            $list = Db::table('indikator_photography_relations')->where('photos_id', $this->id)->get()->all();

            foreach ($list as $item) {
                $category = Categories::whereId($item->blog_categories_id)->first();

                if ($category->status == 1) {
                    $this->_categories[$item->blog_categories_id] = [
                        'name' => $category->name,
                        'slug' => $category->slug
                    ];
                }
            }
        }

        return $this->_categories;
    }

    /**
     * @param $photo_ratio
     */
    private function getRatio($photo_ratio)
    {
        $photo_ratio = (string)$photo_ratio;
        $ratios = [
            '1.33' => '4:3',
            '1.5'  => '3:2',
            '1'    => '1:1',
            '1.78' => '16:9',
            '1.4'  => '5:7',
            '1.25' => '5:4',
            '2'    => '2:1'
        ];

        return isset($ratios[$photo_ratio]) ? $ratios[$photo_ratio] : 0;
    }
}
