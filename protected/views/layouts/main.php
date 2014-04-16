<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="ru"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="ru"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="ru"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="ru"> <!--<![endif]-->
<head>
    <meta charset="utf-8"/>
    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width"/>
    <meta name="description" content=""/>
    <meta name="author" content="Tkachenko Evgeniy"/>
    <?php
    $cs = Yii::app()->clientScript;
    $cs->registerCssFile(Yii::app()->baseUrl . '/css/foundation.css');
    $cs->registerCssFile(Yii::app()->baseUrl . '/css/main.css');
    $cs->registerCssFile(Yii::app()->baseUrl . '/css/app.css');
    ?>
    <!--[if IE ]>

    <![endif]-->
    <link rel="shortcut icon" href="favicon.ico">
    <!-- IE Fix for HTML5 Tags -->
    <!--[if lt IE 9]>
    <script src="/javascripts/html5.js"></script>
    <![endif]-->
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body class="container">

<div class="row">
    <div class="five columns">
        <h3 class="headerTitle">
            Инвентаризация сети <a href="http://10.178.4.2/" title="сайт ВТС">ВТС</a>
        </h3>
    </div>
    <?php
    foreach (Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="alert-box ' . $key . '">' . $message . "</div>\n";
    }
    ?>
    <nav class="six columns">
        <?php
        $this->widget(
            'zii.widgets.CMenu',
            array(
                'items' => array(
                    array(
                        'label' => 'Вход',
                        'url' => array('/user/login'),
                        'visible' => Yii::app()->user->isGuest,
                        'linkOptions' => array('class' => 'navlink')
                    ),
                    array(
                        'label' => 'Личный кабинет (' . Yii::app()->user->name . ' )',
                        'url' => array('/user/profile'),
                        'visible' => !Yii::app()->user->isGuest,
                        'linkOptions' => array('class' => 'navlink')
                    ),
                ),
                'itemCssClass' => 'right navmenu',
            )
        );
        ?>
    </nav>
</div>


<nav class="DashBoard row">
    <?php
    $this->widget(
        'zii.widgets.CMenu',
        array(
            'items' => array(
                array('label' => 'Список компьютеров (таблица)', 'url' => array('/Computers')),
                array(
                    'label' => 'Добавить новый компьютер',
                    'url' => array('/Computers/create'),
                    'visible' => !Yii::app()->user->isGuest,
                ),
                array(
                    'label' => 'Картриджи',
                    'url' => array('/cartridges/admin'),
                    'visible' => !Yii::app()->user->isGuest,
                ),
                array(
                    'label' => 'Сетевое окружение',
                    'url' => array('/Computers/scanner'),
                    'visible' => !Yii::app()->user->isGuest,
                ),
            ),
            'htmlOptions' => array('class' => 'breadcrumbs')
        )
    );
    ?>
</nav>


<div class="row">
    <div class="panel">

        <?php echo $content; ?>

        <footer class="row">
            <p>
            <hr/>
            Информация на этом сайте предназначена только для <?php echo CHtml::link(
            'зарегистрированных пользователей',
            array('/user/registration')
        ); ?> .<br/>
            <p>2010 - <?php echo date("Y") ?></p>
            </p>
        </footer>

    </div>
</div>
<?php
$cs->registerCoreScript('jquery');
$cs->registerScriptFile(Yii::app()->baseUrl . '/javascripts/modernizr.foundation.js');
$cs->registerScriptFile(Yii::app()->baseUrl . '/javascripts/foundation.js');
$cs->registerScriptFile(Yii::app()->baseUrl . '/javascripts/app.js');
?>
</body>
</html>
