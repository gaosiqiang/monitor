<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use yii\widgets\DetailView;
use yii\widgets\LinkPager;
$this->title = Yii::t('app', '日志列表');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="logs-search">

    <?php $form = ActiveForm::begin([
    'action' => ['indexs'],
    'method' => 'get',
]); ?>

<?= $form->field($searchModel, 'site_name')->textInput(['style'=>'width:240px']) ?>

<?= $form->field($searchModel, 'method')->textInput(['style'=>'width:240px']) ?>

<?= Html::activeLabel($searchModel, 'start_time')?>
<?= DatePicker::widget([ 'model' => $searchModel, 'attribute' => 'start_time', 'template' => '{addon}{input}', 'clientOptions' => [ 'autoclose' => true, 'format' => 'yyyy-mm-dd', 'language'=>'zh'] ]);?>
<?= Html::activeLabel($searchModel, 'end_time')?>
<?= DatePicker::widget([ 'model' => $searchModel, 'attribute' => 'end_time', 'template' => '{addon}{input}', 'clientOptions' => [ 'autoclose' => true, 'format' => 'yyyy-mm-dd', 'language'=>'zh' ] ]);?>

<?= $form->field($searchModel, 'status')->dropDownList([0 => '失败', 1 => '成功',2 => '其他'],['prompt'=>'全部','style'=>'width:240px']) ?>

<?php  echo $form->field($searchModel, 'log_type')->dropDownList([0 => 'monitor', 1 => 'error', 2 => 'info'],['prompt'=>'全部','style'=>'width:240px']); ?>

<div class="form-group">
    <?= Html::submitButton(Yii::t('app', '提交'), ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>

<div class="logs-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="logs-view">
    <?php foreach($model as $k => $v) {?>
        <?php
        $start_time = date('Y-m-d H:i:s', intval(substr(strval($v->start_time),0,10)));
        $end_time = date('Y-m-d H:i:s', intval(substr(strval($v->end_time),0,10)));
        ?>
        <?= DetailView::widget([
            'model' => $v,
            'attributes' => [
                'id',
                'method',
                [
                    'attribute' => 'start_time',
                    'value' => $start_time,
                ],
//                'end_time:datetime',
                [
                    'attribute' => 'start_time',
                    'value' => $end_time,
                ],
                'execute_time',
                'status',
                'param_value:ntext',
                'description:ntext',
                'svc_ip',
                'site_name',
                'log_type',
                'date_day',
            ],
        ]) ?>


    <?php }?>
    </div>
    <?= LinkPager::widget(['pagination' => $page,'maxButtonCount'=>10]); ?>

</div>