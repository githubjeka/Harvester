<?php $this->beginContent('//layouts/main'); ?>
<div>
    <div class="columns nine">
        <?php echo $content; ?>
    </div>

    <div class="columns three">

        <?php

        if (Yii::app()->controller->id == 'computers' && Yii::app()->controller->action->id == 'view') {
            $this->beginWidget('zii.widgets.CPortlet', array('title' => '<h4>Меню</h4>'));
            ?>
            <dl class="tabs DdFloatClear">
                <dd><a href="#simple1" class="active">Общая информация</a></dd>
                <dd><a href="#simple2">Материнская плата</a></dd>
                <dd><a href="#simple3">Процессор</a></dd>
                <dd><a href="#simple4">Хранение данных</a></dd>
                <dd><a href="#simple5">Память</a></dd>
                <dd><a href="#simple6">Мультимедиа</a></dd>
                <dd><a href="#simple7">Графические устройства</a></dd>
                <dd><a href="#simple8">Сетевые устройства</a></dd>
                <dd><a href="#simple9">Перефирийные устройства</a></dd>
            </dl>
            <?php
            $this->endWidget();
        }

        $this->beginWidget('zii.widgets.CPortlet', array('title' => '<h4>Операции</h4>'));
        $this->widget('zii.widgets.CMenu', array('items' => $this->menu));
        $this->endWidget();
        ?>

    </div>
</div>
<?php $this->endContent(); ?>