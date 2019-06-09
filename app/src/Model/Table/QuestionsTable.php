<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Questions Model
 */

class QuestionsTable extends Table {

    /**
     * @inheritdoc
     */

    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('questions'); // 使用されるテーブル名
        $this->setDisplayField('id'); // list形式でデータ取得する際に使用されるカラム名
        $this->setPrimaryKey('id'); // プライマリキーとなるカラム名

        $this->addBehavior('Timestamp'); // created及びmodifiedカラムを自動設定する

        $this->hasMany('Answers', [
            'foreignKey' => 'question_id'
        ]);
    }

    /**
     * 回答付きの質問一覧を取得する
     *
     * @return \Cake\ORM\Query 回答付きの質問一覧クエリ
     */
    public function findQuestionsWithAnsweredCount() {
        $query = $this-find();
        $query
            ->select(['answerd_count' => $query->func()->count('Answers.id')])
            ->leftFoinWith('Answers')
            ->group(['Questions.id'])
            ->enableAutoFields(true);

        return $query;
    }

    /**
     * バリデーションルールの定義
     *
     * @param \Cake\Validation\Validator $validator バリデーションインスタンス
     * @return \Cake\Validation\Validator バリデーションインスタンス
     */
    public function validationDefault(Validator $validator) {
        $validator
            ->nonNegativeInteger('id', 'IDが不正です')
            ->allowEmpty('id', 'create', 'IDが不正です');

        $validator
            ->scalar('body', '質問内容が不正です')
            ->requirePresence('body', 'create', '質問内容が不正です')
            ->notEmpty('body', '質問内容は必ず入力してください')
            ->maxLength('body', 140, '質問内容は140文字以内で入力してください');

        return $validator;
    }
}
