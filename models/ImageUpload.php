<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use WebPConvert\WebPConvert;

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
            
            // Tạo thư mục webp
            $webpPath = $path . '/webp/';
            FileHelper::createDirectory($webpPath);
    
            foreach ($this->images as $file) {
                $randomName = Yii::$app->security->generateRandomString(16) . '.' . $file->extension;
                $filePath = $path . '/' . $randomName;
                $file->saveAs($filePath);
    
                // Đường dẫn và tên của hình ảnh WebP
                $webpFilePath = $webpPath . $randomName . '.webp';
    
                try {
                    // Chuyển đổi hình ảnh sang định dạng WebP
                    WebPConvert::convert($filePath, $webpFilePath);
    
                    // Lưu thông tin hình ảnh vào cơ sở dữ liệu
                    $userImage = new UserImage();
                    $userImage->user_id = Yii::$app->user->identity->id;
                    $userImage->name_file = $randomName;
                    $userImage->path = $webpFilePath;
    
                    if (!$userImage->save(false)) {
                        Yii::error('Failed to save image record to database: ' . json_encode($userImage->errors), __METHOD__);
                    }
                } catch (\Exception $e) {
                    Yii::error('Failed to convert image to WebP: ' . $e->getMessage(), __METHOD__);
                }
            }
            return true;
        } else {
            return false;
        }
    }
}