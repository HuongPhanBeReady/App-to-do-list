<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\User $user */

$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flex items-center justify-center min-h-[80vh] ">
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-none">
        <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->email) : ?>
            <h1 class="text-2xl font-bold mb-4"><?= Html::encode($this->title) ?></h1>

            <p class="mb-4">Chào mừng, <?= Html::encode($user->fullname) ?>!</p>

            <p class="mt-4">Email: <?= Html::encode($user->email) ?></p>
            <!-- Thêm các thông tin khác nếu cần -->
        <?php else: ?>
            <p class="text-red-500">Bạn chưa đăng nhập.</p>
        <?php endif; ?>
    </div>
</div>
