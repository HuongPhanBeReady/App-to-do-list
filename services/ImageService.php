<?php
namespace app\services;

use Yii;
use app\models\ImageUpload;
use app\models\UserImage;
use yii\web\ForbiddenHttpException;

class ImageService
{
    public static function isValidReferer($referer, $expectedDomain)
    {
        if (!$referer) {
            return false;
        }
    
        $refererHost = parse_url($referer, PHP_URL_HOST);
    
        return $refererHost === $expectedDomain;
    }

    public static function deleteImage($id, $userId)
    {
        $image = UserImage::findOne([
            'id' => $id,
            'user_id' => $userId,
            'deleted_at' => null
        ]);

        if ($image) {
            $image->deleteImage();
            return true;
        }
        return false;
    }
}
