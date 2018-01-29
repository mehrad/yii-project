<?php 

namespace app\components;

use yii\base\Behavior;
use yii\web\UploadedFile;

class FileBehavior extends Behavior
{
    public $fileAddressAttribute = 'fileAddress';

    public function events()
    {
        return [
            \yii\db\ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
            \yii\db\ActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
            \yii\db\ActiveRecord::EVENT_AFTER_UPDATE => 'afterInsert',
            \yii\db\ActiveRecord::EVENT_BEFORE_DELETE => 'beforeDelete',
            
        ];
    }

    public function beforeValidate($event)
    {
        $this->owner->imageFile = UploadedFile::getInstance($this->owner, 'imageFile');
        if (!is_null($this->owner->imageFile))
        {
             $time = \Yii::$app->formatter->asDate('now', 'php:Y-m-d-h-m-s');
            $this->owner->{$this->fileAddressAttribute} =  $time . '_' .$this->owner->imageFile->baseName .
             '.' . $this->owner->imageFile->extension;
        }
    }

    public function afterInsert($event)
    {
         if (!is_null($this->owner->imageFile) && $this->owner->imageFile != '' && !$this->uploadImage())
            return false;
    }

    public function beforeDelete($event)
    {
        $img = \Yii::$app->basePath . $this->owner->{$this->fileAddressAttribute};
        if($img){
            if (!unlink($img)) {
                return false;
            }
        }
    }

    private function uploadImage()
    {
        try {
            $this->owner->imageFile->saveAs(\Yii::$app->basePath . '/web/uploads/' . $this->owner->{$this->fileAddressAttribute});
        } catch (ErrorException $e) {
            dd($e);
        }
        return true;
    }

    public function getFileUrl()
    {
        return \Yii::$app->urlManager->baseUrl . '/uploads/' . $this->owner->{$this->fileAddressAttribute};
    }
}   

?>