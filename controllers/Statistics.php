<?php namespace Indikator\Photography\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Indikator\Photography\Models\Photos;

class Statistics extends Controller
{
    public $requiredPermissions = ['indikator.photography.statistics'];

    public $photos = 0;

    public $iso = [];

    public $flash = [
        'No'  => 0,
        'Yes' => 0
    ];

    public $orientation = [
        'l' => 0,
        'p' => 0,
        'c' => 0
    ];

    public $ratio = [
        '4:3'  => 0,
        '3:2'  => 0,
        '1:1'  => 0,
        '16:9' => 0,
        '5:7'  => 0,
        '5:4'  => 0,
        '2:1'  => 0
    ];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Indikator.Photography', 'photography', 'statistics');
    }

    public function index()
    {
        $this->pageTitle = 'indikator.photography::lang.menu.statistics';

        $this->addCss('/plugins/indikator/photography/assets/css/statistics.css');

        $this->getStat();

        $this->vars['photos']      = $this->photos;
        $this->vars['iso']         = $this->iso;
        $this->vars['flash']       = $this->flash;
        $this->vars['orientation'] = $this->orientation;
        $this->vars['ratio']       = $this->ratio;
    }

    public function getStat()
    {
        $result = []; 
        $items = Photos::get()->all();

        foreach ($items as $item) {
            $this->flash[$item['exif_flash']]++;
            $this->orientation[$item['exif_orientation']]++;
            $this->ratio[$item['exif_ratio']]++;

            if (array_key_exists($item['exif_iso'], $this->iso)) {
                $this->iso[$item['exif_iso']]++;
            }
            else {
                $this->iso[$item['exif_iso']] = 1;
            }
            ksort($this->iso);

            $this->photos++;
        }
    }
}
