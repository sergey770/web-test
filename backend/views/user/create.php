<? $this->title = 'Добавить члена семьи' ?>

<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($user, 'user_name')->label('Имя') ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>