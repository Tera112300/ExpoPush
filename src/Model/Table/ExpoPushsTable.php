<?php
namespace ExpoPush\Model\Table;
use BaserCore\Model\Table\AppTable;
use Cake\Validation\Validator;
use BaserCore\Utility\BcUtil;
use Cake\Core\Configure;

class ExpoPushsTable extends AppTable
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
        ->scalar('token')
        ->requirePresence('token', 'create', 'トークンは必須です。')
        ->notEmptyString('token', 'トークンは必須です。')
        ->add('token', [
            'nameUnique' => [
                'rule' => function ($value, $context) {
                    $conditions = [
                        'token' => $value
                    ];
                    if (!empty($context['data']['id'])) {
                        $conditions['id !='] = $context['data']['id'];
                    }
                    $query = $this->find()->where($conditions);
                    return $query->count() === 0;
                },
                'message' => '既に登録のあるトークンです。'
            ]
        ]);

      
        return $validator;
    }
    
}
