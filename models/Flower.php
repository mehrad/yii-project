<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "flower".
 *
 * @property integer $id
 * @property integer $likeCount
 * @property string $title
 * @property integer $createdAt
 *
 * @property Comment[] $comments
 * @property FlowerKeyword[] $flowerKeywords
 */
class Flower extends \yii\db\ActiveRecord
{
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
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['keywords'], 'safe'],
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
            'title' => 'Title',
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
    public function getKeywords()
    {
        return $this->hasMany(Keyword::className(), ['id' => 'keywordId'])
             ->viaTable('flower_keyword', ['flowerId' => 'id']);
    }

    public function beforeSave($insert) 
    {
        if (!parent::beforeSave($insert)) {
             return false;
        }
        if ($insert) {
            $this->createdAt = time();
        }

        return true;
    }
}
