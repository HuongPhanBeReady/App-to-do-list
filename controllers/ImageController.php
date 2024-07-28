<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use app\models\ImageUpload;
use yii\web\ForbiddenHttpException;
use app\models\UserImage;
use app\services\ImageService;


class ImageController extends Controller
{
    public function actionUpload()
    {   
        // Định nghĩa domain name dự án của bạn
        $expectedDomain = $_ENV['DOMAIN_NAME'];

        $httpReferer = Yii::$app->request->referrer;
        
        if (!ImageService::isValidReferer($httpReferer, $expectedDomain)) {
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
    
    public function actionGallery()
    {   
        if (Yii::$app->user->isGuest) {
            throw new ForbiddenHttpException('You need to log in to access this page.');
        }
        $userId = Yii::$app->user->identity->id;

        $images = UserImage::find()
            ->where(['user_id' => $userId, 'deleted_at' => null])
            ->all();

        return $this->render('gallery', ['images' => $images]);
    }

    public function actionDelete($id)
    {
        $userId = Yii::$app->user->identity->id;
        if (ImageService::deleteImage($id, $userId)) {
            return $this->redirect(['gallery']);
        }
        throw new \yii\web\NotFoundHttpException('Image not found.');
    }
}