<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Logs;
use frontend\models\LogsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;//分页使用

/**
 * LogsController implements the CRUD actions for Logs model.
 */
class LogsController extends Controller
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
     * Lists all Logs models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LogsSearch();
//                var_dump(Yii::$app->request->queryParams['LogsSearch']);
        $get = $_GET;
        if(array_key_exists('LogsSearch', $_GET)) {
            if (array_key_exists('start_time', $_GET['LogsSearch']) !== '' && array_key_exists('end_time', $_GET['LogsSearch']) !== '') {
                $_GET['LogsSearch']['start_time'] = strval((strtotime($get['LogsSearch']['start_time'])) * 1000);
                $_GET['LogsSearch']['end_time'] = strval((strtotime($get['LogsSearch']['end_time'])) * 1000);
//                Yii::$app->session->setFlash('info', '等待');
            } else {
                Yii::$app->session->setFlash('error', '日期格式不对');
            }
        } else {
            Yii::$app->session->setFlash('info', '没有数据');
        }

        $dataProvider = $searchModel->search($_GET);

        $searchModel->site_name = $get['LogsSearch']['site_name'];
        $searchModel->method = $get['LogsSearch']['method'];
        $searchModel->start_time = $get['LogsSearch']['start_time'];
        $searchModel->end_time = $get['LogsSearch']['end_time'];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
    竖版的
     *
     */
    public function actionIndexs()
    {
        $searchModel = new LogsSearch();
        $get = $_GET;
        if(array_key_exists('LogsSearch', $_GET)) {
            if (array_key_exists('start_time', $_GET['LogsSearch']) !== '' && array_key_exists('end_time', $_GET['LogsSearch']) !== '') {
                $_GET['LogsSearch']['start_time'] = strval((strtotime($get['LogsSearch']['start_time'])) * 1000);
                $_GET['LogsSearch']['end_time'] = strval((strtotime($get['LogsSearch']['end_time'])) * 1000);
                $data = Logs::find()
//                    ->andWhere(['id' => $_GET['LogsSearch']['id']])
//                    ->andWhere(['like', 'method', $_GET['LogsSearch']['method']])
//                    ->andWhere(['like', 'site_name', $_GET['LogsSearch']['site_name']])
                    ->andWhere(['>=', 'start_time', $_GET['LogsSearch']['start_time']])
                    ->andWhere(['<=', 'end_time', $_GET['LogsSearch']['end_time']])
//                    ->andWhere(['status' => $_GET['LogsSearch']['status']])
//                    ->andWhere(['log_type' => $_GET['LogsSearch']['status']])
                ;
                Yii::$app->session->setFlash('info', '共有'.$data->count().'条数据');
            } else {
                Yii::$app->session->setFlash('error', '日期格式不对');
            }
        } else {
            $data = Logs::find();
            Yii::$app->session->setFlash('info', '共有'.$data->count().'条数据');
        }

        $page = new Pagination(['totalCount' => $data->count(), 'pageSize' => '5']);
        $model = $data->offset($page->offset)->limit($page->limit)->all();

        $searchModel->id = $get['LogsSearch']['id'];
        $searchModel->site_name = $get['LogsSearch']['stie_name'];
        $searchModel->method = $get['LogsSearch']['method'];
        $searchModel->start_time = $get['LogsSearch']['start_time'];
        $searchModel->end_time = $get['LogsSearch']['end_time'];

        var_dump($searchModel->load($_GET['LogsSearch']));

        return $this->render('indexs',[
            'searchModel' => $searchModel,
            'model' => $model,
            'page' => $page,
        ]);


    }

    /**
     * Displays a single Logs model.
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
     * Creates a new Logs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Logs();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Logs model.
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
     * Deletes an existing Logs model.
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
     * Finds the Logs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Logs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Logs::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     *
     * 获取data
     *
     */
    protected function getdata($get = array())
    {
        $get = $get['LogsSearch'];

        $data = Logs::find()
                    ->andWhere(['id' => $_GET['LogsSearch']['id']])
                    ->andWhere(['like', 'method', $_GET['LogsSearch']['method']])
                    ->andWhere(['like', 'site_name', $_GET['LogsSearch']['site_name']])
            ->andWhere(['>=', 'start_time', $_GET['LogsSearch']['start_time']])
            ->andWhere(['<=', 'end_time', $_GET['LogsSearch']['end_time']])
            ->andWhere(['status' => $_GET['LogsSearch']['status']])
            ->andWhere(['log_type' => $_GET['LogsSearch']['status']])
        ;
        return $data;
    }

}
