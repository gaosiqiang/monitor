<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ResultsLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '日志曲线');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="results-log-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
    //    foreach ($dataProvider as $k => $v)
    //    {
    //        var_dump($v);
    //    }
    //var_dump($date_array);
    //var_dump($dataProvider);
    //var_dump($sql);
    //var_dump($select);


    //title
    $error_title = '失败';
    $title1 = '第一行';
    $title2 = '第二行';


    ?>
    <div id="test" style="width: auto;height:500px;"></div>
</div>



<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('test'));

    // 指定图表的配置项和数据
    option = {
        title: {
            text: '<?= $map_name;?>曲线图'
        },
        tooltip : {
            trigger: 'axis'
        },
        legend: {
            data:[
                '<?= $error_title?>',
                '<?= $title2?>',
                '<?= $title1?>',
            ]
        },
        toolbox: {
            feature: {
                saveAsImage: {}
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis : [
            {
                type : 'category',
                boundaryGap : false,
                data : [<?= $date;?>]
            }
        ],
        yAxis : [
            {
                type : 'value'
            }
        ],
        series : [
            {
                name:'失败',
                type:'line',
                stack: '总量',
                areaStyle: {normal: {}},
                data:[
                    90, 230, 210,400,800,12,11,12,120, 132, 101, 134, 90, 230, 210,400,800,12,11,12
                ]
            },
            {
                name:'<?= $title2?>',
                type:'line',
                stack: '总量',
                areaStyle: {normal: {}},
                data:[220, 182, 191, 234, 290, 330, 310,220, 182, 191, 234, 290, 330, 310,220, 182, 191,12,34,56]
            },
            {
                name:'<?= $title1?>',
                type:'line',
                stack: '总量',
                label: {
                    normal: {
                        show: true,
                        position: 'top'
                    }
                },
                areaStyle: {normal: {}},
                data:[
                    820, 932, 901, 934, 1290, 1330, 1320,1400,1600,123,345,567,820, 932, 901, 934, 1290,123,345,567
                ]
            }
        ]
    };


    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
</script>