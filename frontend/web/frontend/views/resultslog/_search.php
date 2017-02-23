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

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'method') ?>

    <?= $form->field($model, 'site_name') ?>

    <?= $form->field($model, 'param_name') ?>

    <?= $form->field($model, 'svc_ip') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'date_month') ?>

    <?php // echo $form->field($model, 'date_day') ?>

    <?php // echo $form->field($model, 'date_hour') ?>

    <?php // echo $form->field($model, 'date_minute') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
