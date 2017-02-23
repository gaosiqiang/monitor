<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
// $this->title = 'My Yii Application';
$this->title = 'Montor';
?>
<div class="site-index">

    <div class="jumbotron">
        <?php
        if(!Yii::$app->user->isGuest)
        {?>
            <h1>哈喽傻吊!</h1>
            <p class="lead">"<?= Yii::$app->user->identity->name;?>"你终于上线了你的工号是<?= Yii::$app->user->identity->work_number;?></p>

            <p><a class="btn btn-lg btn-success" href="
        https://www.baidu.com/s?ie=utf-8&f=8&rsv_bp=0&rsv_idx=1&tn=baidu&wd=php%E6%98%AF%E4%B8%96%E7%95%8C%E4%B8%8A%E6%9C%80%E5%A5%BD%E7%9A%84%E8%AF%AD%E8%A8%80&rsv_pq=dc2656e10005c120&rsv_t=eb46fqEJd7eM24r3%2BCao1fzXdvL7aoEPfULemOhLw8bi2Z%2BHkOYiqvLCQuo&rqlang=cn&rsv_enter=1&rsv_sug3=19&rsv_sug1=30&rsv_sug7=100
        ">php是世界上最好的语言</a></p>
        <?php
        }else{
            ?>
            <h1>哈喽傻吊!</h1>
            <p class="lead">还不赶紧登入</p>

            <p><?= Html::a('登入', ['site/login'],['class' => 'btn btn-lg btn-success']) ?></p>
        <?php
        }
        ?>
    </div>

    <div class="body-content">

        <div class="row">
<!--            <div class="col-lg-4">-->
<!--                <h2>Heading</h2>-->
<!---->
<!--                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et-->
<!--                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip-->
<!--                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu-->
<!--                    fugiat nulla pariatur.</p>-->
<!---->
<!--                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>-->
<!--            </div>-->
<!--            <div class="col-lg-4">-->
<!--                <h2>Heading</h2>-->
<!---->
<!--                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et-->
<!--                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip-->
<!--                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu-->
<!--                    fugiat nulla pariatur.</p>-->
<!---->
<!--                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>-->
<!--            </div>-->
<!--            <div class="col-lg-4">-->
<!--                <h2>Heading</h2>-->
<!---->
<!--                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et-->
<!--                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip-->
<!--                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu-->
<!--                    fugiat nulla pariatur.</p>-->
<!---->
<!--                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>-->
<!--            </div>-->
        </div>

    </div>
</div>
