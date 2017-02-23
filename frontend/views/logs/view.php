<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Logs */

$this->title = 'ID'.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '日志列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="logs-view">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'method',
            'start_time:datetime',
            'end_time:datetime',
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

</div>
