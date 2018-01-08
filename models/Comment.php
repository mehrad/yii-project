<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property integer $flowerId
 * @property string $title
 * @property string $body
 * @property string $createdAt
 *
 * @property Flower $flower
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['flowerId'], 'required'],
            [['flowerId'], 'integer'],
            [['body'], 'string'],
            [['createdAt'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['flowerId'], 'exist', 'skipOnError' => true, 'targetClass' => Flower::className(), 'targetAttribute' => ['flowerId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'flowerId' => 'Flower ID',
            'title' => 'Title',
            'body' => 'Body',
            'createdAt' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlower()
    {
        return $this->hasOne(Flower::className(), ['id' => 'flowerId']);
    }
}
