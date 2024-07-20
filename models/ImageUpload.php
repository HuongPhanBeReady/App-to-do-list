<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
// use WebPConvert\WebPConvert;


class ImageUpload extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $images;

    public function rules()
    {
        return [
            [['images'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, webp', 'maxFiles' => 10, 'maxSize' => 2 * 1024 * 1024],
        ];
    }

    public function upload($email)
    {
        if ($this->validate()) {
            $path = Yii::getAlias('@webroot/uploads/' . $email);
            FileHelper::createDirectory($path);
            foreach ($this->images as $file) {
                $randomName = Yii::$app->security->generateRandomString(16) . '.' . $file->extension;
                $filePath = $path . '/' . $randomName;
                $file->saveAs($filePath);

                // Convert to webp
                $webpPath = $path . '/webp/' . $randomName . '.webp';
                FileHelper::createDirectory($path . '/webp');
                \WebPConvert\WebPConvert::convert($filePath, $webpPath);
            }
            return true;
        } else {
            return false;
        }
    }
}
