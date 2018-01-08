<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "flower".
 *
 * @property integer $id
 * @property integer $likeCount
 * @property string $createdAt
 *
 * @property Comment[] $comments
 * @property FlowerKeyword[] $flowerKeywords
 */
class Flower extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'flower';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['likeCount'], 'integer'],
            [['createdAt'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'likeCount' => 'Like Count',
            'createdAt' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['flowerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlowerKeywords()
    {
        return $this->hasMany(FlowerKeyword::className(), ['flowerId' => 'id']);
    }
}
