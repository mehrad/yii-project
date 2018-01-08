<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "flower_keyword".
 *
 * @property integer $id
 * @property integer $flowerId
 * @property integer $keywordId
 * @property string $createdAt
 *
 * @property Flower $flower
 * @property Keyword $keyword
 */
class FlowerKeyword extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'flower_keyword';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['flowerId', 'keywordId'], 'required'],
            [['flowerId', 'keywordId'], 'integer'],
            [['createdAt'], 'safe'],
            [['flowerId'], 'exist', 'skipOnError' => true, 'targetClass' => Flower::className(), 'targetAttribute' => ['flowerId' => 'id']],
            [['keywordId'], 'exist', 'skipOnError' => true, 'targetClass' => Keyword::className(), 'targetAttribute' => ['keywordId' => 'id']],
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
            'keywordId' => 'Keyword ID',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKeyword()
    {
        return $this->hasOne(Keyword::className(), ['id' => 'keywordId']);
    }
}
