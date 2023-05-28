<?php
namespace ExpoPush\Model\Table;
use BaserCore\Model\Table\AppTable;
use Cake\Validation\Validator;
use BaserCore\Utility\BcUtil;
use Cake\Core\Configure;

class ExpoPostsTable extends AppTable
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        //自動更新
        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created' => 'new',
                    'modified' => 'always'
                ]
            ]
        ]);
    }
    public function validationDefault(Validator $validator): Validator
    {
        $validator
        ->integer('id')
        ->allowEmptyString('id', null, 'create');
        
        $validator
        ->requirePresence('name',true,'このフィールドに入力してください')
        ->notEmpty('name','このフィールドに入力してください');
       

      
        return $validator;
    }
    
}
