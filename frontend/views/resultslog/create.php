<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\ResultsLog */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Results Log',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Results Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="results-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
