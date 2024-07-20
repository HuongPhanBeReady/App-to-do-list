<?php

use yii\helpers\Html;

$this->title = 'My Gallery';
?>
<div class="flex flex-col items-center min-h-screen p-4">
    <h1 class="text-3xl font-bold mb-4 text-center"><?= Html::encode($this->title) ?></h1>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 w-full max-w-5xl">
        <?php foreach ($images as $image): ?>
            <div class="relative bg-gray-100 p-2 rounded overflow-hidden">
                <img src="<?= Yii::getAlias('@web') . '/uploads/' . Yii::$app->user->identity->email . '/webp/' . basename($image) ?>" class="w-full h-auto object-cover rounded">
                <?= Html::a('Delete', ['delete', 'filename' => basename($image)], [
                        'class' => 'bg-gray-200 p-2 rounded-full flex items-center justify-center',
                        'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var elem = document.querySelector('.masonry');
    var msnry = new Masonry(elem, {
        itemSelector: '.masonry-item',
        columnWidth: '.masonry-item',
        percentPosition: true
    });
});
</script>