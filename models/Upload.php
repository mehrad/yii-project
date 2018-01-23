<?php 
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class Upload extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxSize' => 1000000],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            try {
            $this->imageFile->saveAs(\Yii::$app->basePath .'/uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            } catch (ErrorException $e) {
                Yii::warning("Can't upload file".$e);
            }
            return true;
        } else {
            return false;
        }
    }
}
?>