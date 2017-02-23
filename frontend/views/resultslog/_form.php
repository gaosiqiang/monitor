<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ResultsLog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="results-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'method')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'site_name')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'param_name')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'svc_ip')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'total')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'date_month')->textInput() ?>

    <?= $form->field($model, 'date_day')->textInput() ?>

    <?= $form->field($model, 'date_hour')->textInput() ?>

    <?= $form->field($model, 'date_minute')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
