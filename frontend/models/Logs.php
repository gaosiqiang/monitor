<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cache_log".
 *
 * @property integer $id
 * @property string $method
 * @property integer $start_time
 * @property integer $end_time
 * @property string $execute_time
 * @property integer $status
 * @property string $param_value
 * @property string $description
 * @property string $svc_ip
 * @property string $site_name
 * @property integer $log_type
 * @property integer $date_day
 */
class Logs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cache_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_time', 'end_time', 'status', 'log_type', 'date_day'], 'integer'],
            [['execute_time'], 'number'],
            [['param_value', 'description'], 'required'],
            [['param_value', 'description'], 'string'],
            [['method', 'svc_ip'], 'string', 'max' => 255],
            [['site_name'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'method' => Yii::t('app', '方法名'),
            'start_time' => Yii::t('app', '开始时间'),
            'end_time' => Yii::t('app', '结束时间'),
            'execute_time' => Yii::t('app', '执行时间'),
            'status' => Yii::t('app', '状态'),
            'param_value' => Yii::t('app', '接口参数'),
            'description' => Yii::t('app', '描述'),
            'svc_ip' => Yii::t('app', '所在服务器的ip。'),
            'site_name' => Yii::t('app', '站点名称'),
            'log_type' => Yii::t('app', '日志类型'),
            'date_day' => Yii::t('app', '统计日期'),
        ];
    }
}
