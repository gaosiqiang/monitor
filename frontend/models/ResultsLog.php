<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "results_log".
 *
 * @property integer $id
 * @property string $method
 * @property string $site_name
 * @property string $param_name
 * @property string $svc_ip
 * @property integer $status
 * @property integer $total
 * @property string $amount
 * @property integer $date_month
 * @property integer $date_day
 * @property integer $date_hour
 * @property integer $date_minute
 */
class ResultsLog extends \yii\db\ActiveRecord
{
    public $select;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'results_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'total', 'date_month', 'date_day', 'date_hour', 'date_minute'], 'integer'],
            [['amount'], 'number'],
            [['method', 'svc_ip'], 'string', 'max' => 255],
            [['site_name'], 'string', 'max' => 128],
            [['param_name'], 'string', 'max' => 64],
            [['method', 'site_name', 'param_name', 'svc_ip', 'status', 'date_minute'], 'unique', 'targetAttribute' => ['method', 'site_name', 'param_name', 'svc_ip', 'status', 'date_minute'], 'message' => 'The combination of Method, Site Name, Param Name, Svc Ip, Status and Date Minute has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'method' => Yii::t('app', '方法名称'),
            'site_name' => Yii::t('app', '站点名'),
            'param_name' => Yii::t('app', 'Param Name'),
            'svc_ip' => Yii::t('app', 'Svc Ip'),
            'status' => Yii::t('app', 'Status'),
            'total' => Yii::t('app', 'Total'),
            'amount' => Yii::t('app', 'Amount'),
            'date_month' => Yii::t('app', 'Date Month'),
            'date_day' => Yii::t('app', '日期'),
            'date_hour' => Yii::t('app', 'Date Hour'),
            'date_minute' => Yii::t('app', 'Date Minute'),
            'select' => Yii::t('app', '日志类型'),
        ];
    }
}
