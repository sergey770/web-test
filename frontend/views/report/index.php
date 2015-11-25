<?$this->title="Отчеты"?>
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

?>




<?php $form = ActiveForm::begin(); ?>


    <?= $form->field($report, 'active_from')->input('date')->label('Дата с')?>
    <?= $form->field($report, 'active_to')->input('date')->label('Дата до')?>
    
    
    
    

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>