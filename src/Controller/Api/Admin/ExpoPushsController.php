<?php
namespace ExpoPush\Controller\Api\Admin;

use BaserCore\Controller\Api\Admin\BcAdminApiController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\Exception\PersistenceFailedException;
use Throwable;
use BaserCore\Annotation\UnitTest;
use BaserCore\Annotation\NoTodo;
use BaserCore\Annotation\Checked;


class ExpoPushsController extends BcAdminApiController
{
    public function add()
    {
        $this->request->allowMethod(['post', 'put', 'patch']);
        $data = $this->ExpoPushs->newEmptyEntity();
        $data = $this->ExpoPushs->patchEntity($data, $this->getRequest()->getData());

        $ExpoPush = null;
        if (!$data->getErrors()) {
            $ExpoPush = $this->ExpoPushs->save($data);
            if($ExpoPush){
                $message = "追加しました。";  
            }else{
                $message = "データベース処理中にエラーが発生しました。";  
            }
        }else{
            $message = "入力エラーです。内容を修正してください。";
        }

        $this->set(compact('ExpoPush','message'));
       
        $this->viewBuilder()->setOption('serialize',['ExpoPush','message']);
    }
}
