<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */
use yii\captcha\Captcha;


use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\captcha\ReCaptcha3;


$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flex items-center justify-center min-h-[80vh] bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-6 text-center"><?= Html::encode($this->title) ?></h1>

        <p class="text-center mb-6">Please fill out the following information to login:</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <div class="mb-4">
                <?= $form->field($model, 'email')->textInput([
                    'autofocus' => true,
                    'class' => 'form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm'
                ]) ?>
            </div>

            <div class="mb-4">
                <?= $form->field($model, 'password')->passwordInput([
                    'class' => 'form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm'
                ]) ?>
            </div>

            <div class="mb-4">
                <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>
            
            </div>

                <div class="form-group">
                    <?= Html::submitButton('Đăng nhập', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
