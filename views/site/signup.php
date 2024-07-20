<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flex items-center justify-center min-h-[80vh] bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-6 text-center"><?= Html::encode($this->title) ?></h1>

        <p class="text-center mb-6">Please fill in the following information to register:</p>

        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <div class="mb-4">
                <?= $form->field($model, 'fullname')->textInput([
                    'autofocus' => true,
                    'class' => 'form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm'
                ]) ?>
            </div>

            <div class="mb-4">
                <?= $form->field($model, 'email')->textInput([
                    'class' => 'form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm'
                ]) ?>
            </div>

            <div class="mb-4">
                <?= $form->field($model, 'password')->passwordInput([
                    'class' => 'form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm'
                ]) ?>
            </div>

            <div class="mb-4">
                <?= $form->field($model, 're_password')->passwordInput([
                    'class' => 'form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm'
                ])->label('Re-enter password') ?>
            </div>

            <div class="text-center">
                <?= Html::submitButton('Signup', [
                    'class' => 'px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-200'
                ]) ?>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
