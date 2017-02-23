<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use kartik\datetime\DateTimePicker;//另一个日期控件

/* @var $this yii\web\View */
/* @var $model frontend\models\LogsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="logs-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'site_name')->textInput(['style'=>'width:240px']) ?>
    <?= $form->field($model, 'method')->textInput(['style'=>'width:240px']) ?>

    <?= Html::activeLabel($model, 'start_time')?>
    <?= DatePicker::widget([ 'model' => $model, 'attribute' => 'start_time', 'template' => '{addon}{input}', 'clientOptions' => [ 'autoclose' => true, 'format' => 'yyyy-mm-dd', 'language'=>'zh'] ]);?>
    <?= Html::activeLabel($model, 'end_time')?>
    <?= DatePicker::widget([ 'model' => $model, 'attribute' => 'end_time', 'template' => '{addon}{input}', 'clientOptions' => [ 'autoclose' => true, 'format' => 'yyyy-mm-dd', 'language'=>'zh' ] ]);?>

    <?= $form->field($model, 'status')->dropDownList([0 => '失败', 1 => '成功',2 => '其他'],['prompt'=>'全部','style'=>'width:240px']) ?>

    <?php  echo $form->field($model, 'log_type')->dropDownList([0 => 'monitor', 1 => 'error', 2 => 'info'],['prompt'=>'全部','style'=>'width:240px']); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', '提交'), ['class' => 'btn btn-primary']) ?>
        <?php //echo Html::resetButton(Yii::t('app', '重置'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
