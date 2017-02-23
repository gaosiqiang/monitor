<?php

namespace frontend\controllers;

use Yii;
use frontend\models\ResultsLog;
use frontend\models\ResultsLogSearch;
use frontend\models\Droplist;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ResultsLogController implements the CRUD actions for ResultsLog model.
 */
class ResultsLogController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ResultsLog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $Model = new ResultsLog();
        $Model->select = Yii::$app->request->get('ResultsLog')['select'] ? Yii::$app->request->get('ResultsLog')['select'] : 1;
        $select = $this->checkselect($Model->select);
        $select = $select->attributes;

        //处理多曲线的问题
        if($Model->select == 5 || $Model->select == 6)
        {
            $date = $this->getday();
            $res = $this->day_quadrant($date,$Model->select);
            return $this->render('indexs', [
                'searchModel' => $Model,
                'model' => $Model,
                'date' => $date['day_array'],
//                'data' => $data,
                'site_name' => $select['site_name'],
                'method' => $select['method'],
                'map_name' => $select['map_name'],
                'select' => $select,
            ]);
        }

        $sql = $this->getsql($select);

        $dataProvider = Yii::$app->db->createCommand($sql)->queryAll();
        $gethour = $this->gethourarray();
        $date = $gethour['date'];
        $date_array = $gethour['date_array'];
        $x = $this->quadrant($date_array,$dataProvider);
        $x1 = $x['x1'];
        $x2 = $x['x2'];
        $data = $x['data'];

        return $this->render('index', [
            'searchModel' => $Model,
            'model' => $Model,
            'dataProvider' => $dataProvider,
            'date' => $date,
            'date_array' => $date_array,
            'data' => $data,
            'x1' => $x1,
            'x2' => $x2,
            'site_name' => $select['site_name'],
            'method' => $select['method'],
            'map_name' => $select['map_name'],
            'sql' => $sql,
            'select' => $select,
        ]);
    }


    //数据补0
    protected function checkdata($int,$dataProvider = array())
    {
        foreach($dataProvider as $k => $v)
        {
            if($v['date_hour'] == $int)
            {
                return $v;
            }

        }
        return false;
    }

    //下拉列表的数据返回
    protected function checkselect($select)
    {
        return Droplist::find()->where(['id' => $select])->one();
    }


    //
    protected function getsql($select)
    {
        return "
        SELECT
            date_hour, SUM(".$select['sum'].") number, status
        FROM
            results_log
        WHERE
            method = '".$select['method']."'
                AND site_name = '".$select['site_name']."'
                AND date_hour
                between cast(date_format(date_add(now(),interval -23 hour),'%Y%m%d%H') as signed)
                and cast(date_format(now(),'%Y%m%d%H') as  signed)
        GROUP BY `date_hour`;
        ";
    }

    //获取小时数组
    protected function gethourarray()
    {
        $hour = date('H');
        $date = '';
        $date_array = array();
        $lh = $hour + 1;
        while($lh <= 23)
        {
            $date .= '"'.str_pad($lh,2,"0",STR_PAD_LEFT).'",';
            $date_array[] = date('Ym').(date('d')-1).str_pad($lh,2,"0",STR_PAD_LEFT);
            $lh++;
        }
        $rh = 0;
        while($rh <= $hour)
        {
            $date .= '"'.str_pad($rh,2,"0",STR_PAD_LEFT).'",';
            $date_array[] = date('Ym').(date('d')).str_pad($rh,2,"0",STR_PAD_LEFT);
            $rh++;
        }
        $res['date'] = $date;
        $res['date_array'] = $date_array;
        return $res;
    }

    //获取天数数组
    protected function getday()
    {
        $day = date('d');
        $day_array = '';
        $start = '';
        $end = date('Ymd');
        if($day > 20)
        {
            $rd = $day - 19;
            while($rd <= $day)
            {
                $day_array .= '"'.str_pad($rd,2,"0",STR_PAD_LEFT).'",';
                $rd++;
            }
            $start = date('Ym').$rd;
        }elseif($day == 20)
        {
            $rd = 1;
            while($rd <= $day)
            {
                $day_array .= '"'.str_pad($rd,2,"0",STR_PAD_LEFT).'",';
                $rd++;
            }
            $start = date('Ym').$rd;
        }elseif($day <20)
        {
            $rd = 1;
            if(in_array((date('m') - 1),[1,3,5,7,8,10,12]))
            {
                $ld = 31 - (19 - $day);
                while($ld <= 31)
                {
                    $day_array .= '"'.str_pad($ld,2,"0",STR_PAD_LEFT).'",';
                    $ld++;
                }
                $start = date('Y').(date('m') - 1).$ld;
            }else{
                $ld = 30 - (19 - $day);
                while($ld <= 30)
                {
                    $day_array .= '"'.str_pad($ld,2,"0",STR_PAD_LEFT).'",';
                    $ld++;
                }
                $start = date('Y').(date('m') - 1).$ld;

            }
            while($rd <= $day)
            {
                $day_array .= '"'.str_pad($rd,2,"0",STR_PAD_LEFT).'",';
                $rd++;
            }
        }
        $res['day_array'] = $day_array;
        $res['start'] = $start;
        $res['end'] = $end;
        return $res;

    }
    //获取双曲线象限数据
    protected function quadrant($date_array,$dataProvider)
    {
        $x1 = '';
        $x2 = '';
        foreach($date_array as $k => $v)
        {
            if($dv = $this->checkdata($v,$dataProvider))
            {
                $data[$k]['date_hour'] = $dv['date_hour'];
                $data[$k]['number'] = $dv['number'];
                $x1 .= $dv['number'].',';
                if($dv['status'] == 1)
                {
                    $x2 .= '0,';
                }else{
                    $x2 .= $dv['number'].',';
                }
            }else{
                $data[$k]['date_hour'] = $v;
                $data[$k]['number'] = 0;
                $x1 .= '0,';
                if($dv['status'] == 1)
                {
                    $x2 .= '0,';
                }else{
                    $x2 .= $dv['number'].',';
                }
            }
        }

        $x['x1'] = $x1;
        $x['x2'] = $x2;
        $x['data'] = $data;
        return $x;

    }

    //获取多曲线象限数据
    protected function day_quadrant()
    {

    }


    /**
     * Displays a single ResultsLog model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ResultsLog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ResultsLog();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ResultsLog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ResultsLog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ResultsLog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ResultsLog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ResultsLog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
