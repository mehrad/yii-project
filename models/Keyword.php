<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "keyword".
 *
 * @property integer $id
 * @property string $title
 * @property integer $createdAT
 *
 * @property FlowerKeyword[] $flowerKeywords
 */
class Keyword extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'keyword';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['createdAT'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'createdAT' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlowerKeywords()
    {
        return $this->hasMany(FlowerKeyword::className(), ['keywordId' => 'id']);
    }
}
