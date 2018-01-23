<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

class Flower extends \yii\db\ActiveRecord
{
    public $avatar;
    private $keywords;

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
            [['keywords'], 'required'],
            [['avatar'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'likeCount' => 'Like Count',
            'title' => 'Title',
            'createdAt' => 'Created At',
            'keywords' => 'Keywords',
            'avatar' => 'Avatar',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['flowerId' => 'id']);
    }

    public function setKeywords($value)
    {
        $this->keywords = $value;
    }

    public function getKeywords()
    {
        if (!isset($this->keywords)) {
            $this->keywords = ArrayHelper::getColumn($this->getKeywordsRelation()->all(), 'title');
        }
        return $this->keywords;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKeywordsRelation()
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

    public function afterSave($insert, $changedAttributes)
    {   
        parent::afterSave($insert, $changedAttributes);

        $this->unlinkAll('keywordsRelation', true); 
        foreach ($this->keywords as $keyword) {
            $obj = Keyword::find()->where(['title' => $keyword])->one();
            if ($obj == null){
                $obj = new keyword(['title' => $keyword]);
                $obj->save();
            }
            $this->link('keywordsRelation', $obj);
        }

    }
}
