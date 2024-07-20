<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Upload Image';
?>
<div class="flex items-center justify-center min-h-[80vh]">
    <div class="image-upload p-4 w-full max-w-md">
        <h1 class="text-3xl font-bold mb-4 text-center"><?= Html::encode($this->title) ?></h1>
        
        <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data']
        ]); ?>

        <?= $form->field($model, 'images[]')->fileInput(['multiple' => true, 'accept' => 'image/*', 'id' => 'image-input']) ?>

        <div id="preview" class="flex flex-wrap justify-center mb-4"></div>

        <div class="form-group text-center">
            <?= Html::submitButton('Upload', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<script>
document.getElementById('image-input').addEventListener('change', function(event) {
    const files = event.target.files;
    const preview = document.getElementById('preview');
    preview.innerHTML = '';
    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'w-[100px] h-[100px] object-cover m-2'; // Kích thước và khoảng cách ảnh
            preview.appendChild(img);
        };
        reader.readAsDataURL(file);
    }
});
</script>
