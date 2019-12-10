<?php namespace Indikator\Photography\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Indikator\Photography\Models\Photos;

class Statistics extends Controller
{
    public $requiredPermissions = ['indikator.photography.statistics'];

    public $photos = 0;

    public $model = [];

    public $iso = [];

    public $aperture = [];

    public $exposure = [];

    public $focal = [];

    public $ratio = [
        '4:3'  => 0,
        '3:2'  => 0,
        '1:1'  => 0,
        '16:9' => 0,
        '5:7'  => 0,
        '5:4'  => 0,
        '2:1'  => 0
    ];

    public $orientation = [
        'l' => 0,
        'p' => 0,
        'c' => 0
    ];

    public $flash = [
        'No'  => 0,
        'Yes' => 0
    ];

    public $filesize = [
        'max' => 0,
        'min' => 0,
        'avg' => 0
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
        $this->vars['model']       = $this->model;
        $this->vars['ratio']       = $this->ratio;
        $this->vars['orientation'] = $this->orientation;
        $this->vars['flash']       = $this->flash;
        $this->vars['iso']         = $this->iso;
        $this->vars['filesize']    = $this->filesize;
        $this->vars['aperture']    = $this->aperture;
        $this->vars['exposure']    = $this->exposure;
        $this->vars['focal']       = $this->focal;
    }

    public function getStat()
    {
        $result = [];
        $min = $max = $avg = 0;
        $items  = Photos::get()->all();

        foreach ($items as $item) {
            // Simple increase
            $this->photos++;
            $this->ratio[$item['exif_ratio']]++;
            $this->orientation[$item['exif_orientation']]++;
            $this->flash[$item['exif_flash']]++;

            // Filesize
            if ($item['filesize'] > $max) {
                $max = $item['filesize'];
            }
            if ($item['filesize'] < $min || $min == 0) {
                $min = $item['filesize'];
            }
            $avg += $item['filesize'];

            // Model
            if (array_key_exists($item['exif_model'], $this->model)) {
                $this->model[$item['exif_model']]++;
            }
            else {
                $this->model[$item['exif_model']] = 1;
            }

            // ISO
            if (array_key_exists($item['exif_iso'], $this->iso)) {
                $this->iso[$item['exif_iso']]++;
            }
            else {
                $this->iso[$item['exif_iso']] = 1;
            }

            // Aperture
            if (array_key_exists($item['exif_aperture'], $this->aperture)) {
                $this->aperture[$item['exif_aperture']]++;
            }
            else {
                $this->aperture[$item['exif_aperture']] = 1;
            }

            // Exposure
            if (substr_count($item['exif_exposure'], '/') == 0) {
                $item['exif_exposure'] .= '"';
            }
            if (array_key_exists($item['exif_exposure'], $this->exposure)) {
                $this->exposure[$item['exif_exposure']]++;
            }
            else {
                $this->exposure[$item['exif_exposure']] = 1;
            }

            // Focal
            if (array_key_exists($item['exif_focal'], $this->focal)) {
                $this->focal[$item['exif_focal']]++;
            }
            else {
                $this->focal[$item['exif_focal']] = 1;
            }
        }

        // Filesize
        $this->filesize['max'] = round($max / 1048576, 1);
        $this->filesize['min'] = round($min / 1048576, 1);
        $this->filesize['avg'] = ($this->photos > 0) ? (round(($avg / $this->photos) / 1048576, 1)) : 0;

        // Sorting
        arsort($this->model);
        arsort($this->iso);
        arsort($this->aperture);
        arsort($this->exposure);
        arsort($this->focal);
    }
}
