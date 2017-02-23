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
class Droplist extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'droplist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['id', 'integer'],
            [['method', 'site_name','map_name'], 'string', 'max' => 225],
            ['sum', 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '编号'),
            'method' => Yii::t('app', '方法名称'),
            'site_name' => Yii::t('app', '站点名'),
            'map_name' => Yii::t('app','图标名'),
            'sum' => Yii::t('app','计算字段')
        ];
    }
}
