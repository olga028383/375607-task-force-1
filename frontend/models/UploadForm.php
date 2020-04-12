<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class UploadForm extends Model
{

    /**
     * @var $files
     */
    public $files = array();


    public function rules()
    {
        return [
            [['files'], 'files'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {

            $dir = Yii::getAlias('@app/uploads');

            if (!file_exists($dir)) {
                FileHelper::createDirectory($dir);
            }

            $path = $dir . '/' . $this->files->baseName . '.' . $this->files->extension;
            //$this->file->saveAs($path);

            return $path;
        }

        return false;

    }
}