<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use app\models\ImageUpload;
use yii\helpers\FileHelper;
use yii\web\ForbiddenHttpException;
class ImageController extends Controller
{
    public function actionUpload()
    {   
        // Định nghĩa domain name dự án của bạn
        $expectedDomain = $_ENV['DOMAIN_NAME'];

        $httpReferer = Yii::$app->request->referrer;
        
        if (!$this->isValidReferer($httpReferer, $expectedDomain)) {
            throw new ForbiddenHttpException('Invalid domain for file upload.');
        }
        $model = new ImageUpload();

        if (Yii::$app->request->isPost) {
            $model->images = UploadedFile::getInstances($model, 'images');
            if ($model->upload(Yii::$app->user->identity->email)) {
                return $this->redirect(['gallery']);
            }
        }

        return $this->render('upload', ['model' => $model]);
    }
    private function isValidReferer($referer, $expectedDomain)
    {
            
        if (!$referer) {
            return false;
        }
    
        $refererHost = parse_url($referer, PHP_URL_HOST);
    
        return $refererHost === $expectedDomain;
    }
    
    public function actionGallery()
    {
        $email = Yii::$app->user->identity->email;
        $path = Yii::getAlias('@webroot/uploads/' . $email . '/webp');
        $images = [];
        if (is_dir($path)) {
            $images = FileHelper::findFiles($path, ['only' => ['*.webp']]);
        }

        return $this->render('gallery', ['images' => $images]);
    }

    public function actionDelete($filename)
    {
        $email = Yii::$app->user->identity->email;
        $path = Yii::getAlias('@webroot/uploads/' . $email . '/webp/' . $filename);
        if (file_exists($path)) {
            unlink($path);
        }
        return $this->redirect(['gallery']);
    }

}
