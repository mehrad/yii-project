<?php 

namespace app\components;

use yii\base\Behavior;
use yii\web\UploadedFile;

class FileBehavior extends Behavior
{
    public $fileNameAttribute = 'fileName';

    public function events()
    {
        return [
            \yii\db\ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
            \yii\db\ActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
            \yii\db\ActiveRecord::EVENT_AFTER_UPDATE => 'afterInsert',
            \yii\db\ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
            
        ];
    }

    public function beforeValidate($event)
    {
        $this->owner->imageFile = UploadedFile::getInstance($this->owner, 'imageFile');
        if (!is_null($this->owner->imageFile))
        {
             $time = \Yii::$app->formatter->asDate('now', 'php:Y-m-d-h-m-s');
            $this->owner->{$this->fileNameAttribute} =  $time . '_' .$this->owner->imageFile->baseName .
             '.' . $this->owner->imageFile->extension;
        }
    }

    public function afterInsert($event)
    {
         if (!is_null($this->owner->imageFile) && $this->owner->imageFile != '' && !$this->uploadImage())
            return false;
    }

    public function afterDelete($event)
    {
        if($this->hasFile()){
            unlink($this->getFilePath());
        }
    }

    private function uploadImage()
    {
        try {
            $this->owner->imageFile->saveAs(\Yii::$app->basePath . '/web/uploads/' . $this->owner->{$this->fileNameAttribute});
        } catch (ErrorException $e) {
            dd($e);
        }
        return true;
    }

    public function getFileUrl()
    {
        return \Yii::$app->urlManager->baseUrl . '/uploads/' . $this->owner->{$this->fileNameAttribute};
    }

    public function getFilePath()
    {
        return \Yii::$app->basePath . '/web/uploads/' . $this->owner->{$this->fileNameAttribute};
    }    

    public function hasFile()
    {
        return isset($this->owner->{$this->fileNameAttribute});
    }

    public function deleteFile()
    {
        if($this->hasFile()){
            unlink($this->getFilePath());
            $this->owner->imageAdress = null;
            $this->owner->save(false);        
        }
        return true;
    }
}   

?>