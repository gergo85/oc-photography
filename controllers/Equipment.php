<?php namespace Indikator\Photography\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Indikator\Photography\Models\Equipment as Item;
use Flash;
use Lang;

class Equipment extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
        \Backend\Behaviors\ReorderController::class
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $requiredPermissions = ['indikator.photography.equipment'];

    public $bodyClass = 'compact-container';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Indikator.Photography', 'photography', 'equipment');
    }

    public function onActivate()
    {
        if ($this->nothingIsSelected()) {
            return $this->listRefresh();
        }

        $this->changeStatus(post('checked'), 2, 1);
        $this->setMsg('activate');

        return $this->listRefresh();
    }

    public function onDeactivate()
    {
        if ($this->nothingIsSelected()) {
            return $this->listRefresh();
        }

        $this->changeStatus(post('checked'), 1, 2);
        $this->setMsg('deactivate');

        return $this->listRefresh();
    }

    public function onRemove()
    {
        if ($this->nothingIsSelected()) {
            return $this->listRefresh();
        }

        foreach (post('checked') as $itemId) {
            if (! $item = Item::whereId($itemId)) {
                continue;
            }

            $item->delete();
        }

        $this->setMsg('remove');

        return $this->listRefresh();

    }

    public function onShowImage()
    {
        $this->vars['title'] = Item::where('image', post('image'))->value('name');
        $this->vars['image'] = '/storage/app/media'.post('image');

        return $this->makePartial('show_image');
    }

    /**
     * @return bool
     */
    private function nothingIsSelected()
    {
        return ! ($checkedIds = post('checked')) || ! is_array($checkedIds) || ! count($checkedIds);
    }

    /**
     * @param $action
     */
    private function setMsg($action)
    {
        Flash::success(Lang::get('indikator.photography::lang.flash.'.$action));
    }

    /**
     * @param $post
     * @param $from
     * @param $to
     */
    private function changeStatus($post, $from, $to)
    {
        foreach ($post as $itemId) {
            if (!$item = Item::where('status', $from)->whereId($itemId)) {
                continue;
            }

            $item->update(['status' => $to]);
        }
    }
}
