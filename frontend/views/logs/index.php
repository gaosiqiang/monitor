<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LogsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '日志列表');
$this->params['breadcrumbs'][] = $this->title;
//var_dump($Model->createCommand()->getRawSql());
foreach($dataProvider as $k => $v)
{
    var_dump($v);
}

var_dump($searchModel);
?>
<div class="logs-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'site_name',
            'method',
//            'start_time:datetime',
            [
                'attribute' => 'start_time',
                'value' => function ($model) {
                    return date('Y-m-d H:i:s', $model->start_time/1000);
                },
            ],
//            'end_time:datetime',
            [
                'attribute' => 'end_time',
                'value' => function ($model) {
                    return date('Y-m-d H:i:s', $model->end_time/1000);
                },
            ],
//            'execute_time',
            [
                'attribute' => 'status',
                'label'=>'状态',
                'value' => function ($model) {
                    $state = [
                        0 => '失败',
                        1 => '成功',
                        2 => '其他',
                    ];
                    return $state[$model->status];
                },
                'filter' => [0 => '失败', 1 => '成功',2 => '其他'],
            ],
            // 'param_value:ntext',
            // 'description:ntext',
            // 'svc_ip',

            [
                'attribute' => 'log_type',
                'value' => function ($model) {
                    $state = [
                        0 => 'monitor',
                        1 => 'error',
                        2 => 'info',
                    ];
                    return $state[$model->log_type];
                },
                'filter' => [0 => 'monitor', 1 => 'error', 2 => 'info'],
            ],
             'date_day',

            ['class' => 'yii\grid\ActionColumn','template' => '{view}','header' => '操作'],
        ],
    ]); ?>

</div>
