<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cards".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $id_comment
 * @property string $date
 */
class Cards extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cards';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'string'],
            [['id_comment'], 'string'],
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
            'title' => 'Title',
            'description' => 'Description',
            'id_comment' => 'Id Comment',
            'date' => 'Date',
        ];
    }
}
