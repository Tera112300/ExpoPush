<?php
namespace ExpoPush\Model\Entity;

use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;
use BaserCore\Annotation\UnitTest;
use BaserCore\Annotation\NoTodo;
use BaserCore\Annotation\Checked;
use Cake\Core\Configure;


class ExpoPush extends Entity
{
    /**
     * Accessible
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
