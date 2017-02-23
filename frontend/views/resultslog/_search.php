<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ResultsLogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="results-log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


    <?= $form->field($model, 'select')->dropDownList(\yii\helpers\ArrayHelper::map(\frontend\models\Droplist::find()->all(),'id','map_name'),['prompt'=>'请选择','style'=>'width:240px']);?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', '提交'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
