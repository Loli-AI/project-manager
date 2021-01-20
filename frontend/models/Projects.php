<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "projects".
 *
 * @property int $id
 * @property string $name
 * @property string|null $relation
 * @property string|null $id_list
 * @property string|null $id_user
 * @property int $is_master
 * @property string $date
 */
class Projects extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'relation', 'id_list', 'id_user'], 'string'],
            [['is_master'], 'integer'],
            [['date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'relation' => 'Relation',
            'id_list' => 'Id List',
            'id_user' => 'Id User',
            'is_master' => 'Is Master',
            'date' => 'Date',
        ];
    }
}
