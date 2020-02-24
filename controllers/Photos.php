<?php namespace Indikator\Photography\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Indikator\Photography\Models\Photos as Item;
use Db;
use Flash;
use Lang;

class Photos extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = ['indikator.photography.photos'];

    public $bodyClass = 'compact-container';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Indikator.Photography', 'photography', 'photos');
    }

    public function onActivate()
    {
        if ($this->isSelected()) {
            $this->changeStatus(post('checked'), 2, 1);
            $this->setMessage('activate');
        }

        return $this->listRefresh();
    }

    public function onInactivate()
    {
        if ($this->isSelected()) {
            $this->changeStatus(post('checked'), 1, 2);
            $this->setMessage('inactivate');
        }

        return $this->listRefresh();
    }

    public function onRemove()
    {
        if ($this->isSelected()) {
            foreach (post('checked') as $itemId) {
                if (! $item = Item::whereId($itemId)) {
                    continue;
                }

                $item->delete();

                Db::table('indikator_photography_relations')->where('photos_id', $itemId)->delete();
            }

            $this->setMessage('remove');
        }

        return $this->listRefresh();
    }

    /**
     * @return bool
     */
    private function isSelected()
    {
        return ($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds);
    }

    /**
     * @param $action
     */
    private function setMessage($action)
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

    public function onShowImage()
    {
        $this->vars['title'] = Item::where('image', post('image'))->value('name');
        $this->vars['image'] = '/storage/app/media'.post('image');

        return $this->makePartial('show_image');
    }
}
