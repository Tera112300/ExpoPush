<?php
namespace ExpoPush\Controller\Admin;

use BaserCore\Utility\BcUtil;
use BaserCore\Utility\BcSiteConfig;
use Cake\Core\Configure;
use BaserCore\Error\BcException;

use ExponentPhpSDK\Expo;


class ExpoPostsController extends ExpoPushAdminAppController
{
    protected $Expo;
    protected $channelName = "push_app";
    protected $ExpoPushs;
    public function initialize(): void
    {
        parent::initialize();
        $this->Expo = Expo::normalSetup();
        //loadmodelは4.3から非推奨になるので、なるべくfetchTableを使う
        $this->ExpoPushs = $this->fetchTable('ExpoPush.ExpoPushs');
    }

    public function index()
    {
        $this->setViewConditions('ExpoPosts', [
            'default' => [
            'query' => [
            'limit' => BcSiteConfig::get('admin_list_num'),
            'sort' => 'id',
            'direction' => 'desc',
        ]]]);
        $datas = $this->paginate($this->ExpoPosts->find());
        $topLevelUrl = BcUtil::topLevelUrl();
        $this->set(compact("datas","topLevelUrl"));
    }


    public function edit(int $id = 0)
    {
        $data = $this->ExpoPosts->find()->where(['id' => $id])->first();
        
        if(!isset($data)) return $this->redirect(['action' => 'index']);

        if ($this->request->is(['post','put'])) {
            $updata = $this->ExpoPosts->patchEntity($data,$this->getRequest()->getData());

            if (!$updata->getErrors()) {
                if($this->ExpoPosts->save($updata)){

                    $ExpoPushs_datas = $this->ExpoPushs->find();
                    if($this->getRequest()->getData("push_flag") == 1 && !$ExpoPushs_datas->isEmpty()){
                        try{
                            foreach($ExpoPushs_datas as $ExpoPushs_data){
                                $this->Expo->subscribe($this->channelName,$ExpoPushs_data->token);
                            }
                            $notification = ['title' => $this->getRequest()->getData("name"),'body' => $this->getRequest()->getData("description")];
                            $this->Expo->notify([$this->channelName],$notification);
                        }catch(\Exception $e){
                            $this->BcMessage->setError('プッシュ通知送信中にエラーが発生しました。');
                        }
                    }

                    $this->BcMessage->setInfo('更新しました。');
                }else{
                    $this->BcMessage->setError('データベース処理中にエラーが発生しました。');
                }
                return $this->redirect(['action' => 'edit',$id]);
            }
        }
       
        $this->set(compact("data"));
    }


    public function add()
    {
        $data = $this->ExpoPosts->newEmptyEntity();
        if ($this->request->is(['post','put'])) {
            $data = $this->ExpoPosts->patchEntity($data, $this->getRequest()->getData());
            if (!$data->getErrors()) {
                if($this->ExpoPosts->save($data)){
                    
                    $ExpoPushs_datas = $this->ExpoPushs->find();
                    if($this->getRequest()->getData("push_flag") == 1 && !$ExpoPushs_datas->isEmpty()){
                        try{
                            foreach($ExpoPushs_datas as $ExpoPushs_data){
                                $this->Expo->subscribe($this->channelName,$ExpoPushs_data->token);
                            }
                            $notification = ['title' => $this->getRequest()->getData("name"),'body' => $this->getRequest()->getData("description")];
                            $this->Expo->notify([$this->channelName],$notification);
                        }catch(\Exception $e){
                            $this->BcMessage->setError('プッシュ通知送信中にエラーが発生しました。');
                        }
                    }

                    $this->BcMessage->setInfo('プッシュ通知の記事を登録しました。');
                    return $this->redirect(['action' => 'index']);
                }else{
                    $this->BcMessage->setError('データベース処理中にエラーが発生しました。');
                    return $this->redirect(['action' => 'index']);
                }
            }
        }
        $this->set(compact('data'));
    }

    public function delete(int $id)
    {
        $this->getRequest()->allowMethod(['post','delete']);
        $data = $this->ExpoPosts->find()->where(['id' => $id])->first();
        if(!isset($data)) return $this->redirect(['action' => 'index']);

        try {
            $this->ExpoPosts->delete($data);
            $this->BcMessage->setSuccess('削除しました。');
        }catch (BcException $e) {
            $this->BcMessage->setError('データベース処理中にエラーが発生しました。'. $e->getMessage());
        }
        return $this->redirect(['action' => 'index']);
    }

}
