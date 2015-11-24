<?$this->title="Отчеты"?>
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

?>




<?php $form = ActiveForm::begin(); ?>


    <?= $form->field($report, 'active_from')->input('date')?>
    <?= $form->field($report, 'active_to')->input('date')?>
    
    
    
    

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>