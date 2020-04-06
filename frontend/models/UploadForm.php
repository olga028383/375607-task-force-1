<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class UploadForm extends Model
{

    /**
     * @var $file
     */
    public $file;


    public function rules()
    {
        return [
            [['file'], 'file'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {

            $dir = Yii::getAlias('@app/uploads');

            if (!file_exists($dir)) {
                FileHelper::createDirectory($dir);
            }

            $path = $dir . '/' . $this->file->baseName . '.' . $this->file->extension;
            $this->file->saveAs($path);

            return $path;
        }

        return false;

    }
}