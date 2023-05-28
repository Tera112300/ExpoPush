<?php
namespace ExpoPush\Controller\Admin;

use BaserCore\Controller\Admin\BcAdminAppController;
use Cake\Event\EventInterface;

use BaserCore\Annotation\NoTodo;
use BaserCore\Annotation\Checked;


class ExpoPushAdminAppController extends BcAdminAppController
{

    public function beforeRender(EventInterface $event): void
    {
        parent::beforeRender($event);
    }
}
