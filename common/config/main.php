<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
    'language' => 'zh-CN',
    'name' => 'monitor',
    'charset' =>'utf-8',
    'timeZone'=>'Asia/Shanghai',
];
