<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Logs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="logs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'method')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'start_time')->textInput() ?>

    <?= $form->field($model, 'end_time')->textInput() ?>

    <?= $form->field($model, 'execute_time')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'param_value')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'svc_ip')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'site_name')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'log_type')->textInput() ?>

    <?= $form->field($model, 'date_day')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
