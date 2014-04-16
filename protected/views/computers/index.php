<?php
$this->breadcrumbs = array(
    'Компьютеры',
);

$this->menu = array(
    array('label' => 'Создать компьютер', 'url' => array('create')),
    array('label' => 'Компьютеры онлайн', 'url' => array('scanner')),
);
?>

<h4 class="left">Сводная таблица</h4>

<?php
Yii::app()->clientScript->registerScript(
    'search',
    "
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('computers-grid', {
		data: $(this).serialize()
	});
	return false;
});
"
);
?>

<?php

$this->widget(
    'ext.groupgridview.GroupGridView',
    array(
        'id' => 'grid1',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'mergeColumns' => array('Department'),
        'summaryText' => 'Отображены
            <div class="form no-border" style="margin: 0; display:inline-block; vertical-align: middle;"> '
            . CHtml::dropDownList(
                'rowPerPage',
                User::getResultsPerPage(),
                Computers::getPossibleResultsPerPage(),
                array(
                    'ajax' => array(
                        'url' => $this->createUrl('/Computers/setResultsPerPage'),
                        'complete' => "function(response) { $.fn.yiiGridView.update('grid1', {data: {'id_page': 1}}) }",
                        'data' => "js: {rowPerPage: $(this).val()}",
                    ),
                    'style' => 'margin: 0;',
                )
            )
            . ' </div> компьютеров из {count}'
    ,
        'columns' => array(
            array(
                'name' => 'inventar_number',
            ),
            'year_build',
            array(
                'name' => 'Department',
                'filter' => CHtml::listData(
                    $model->findAll(array('select' => 'Department')),
                    'Department',
                    'Department'
                ),
            ),
            array(
                'name' => 'name',
                'type' => 'raw',
                'value' => 'CHtml::link($data->name, array("view","id"=>$data->id))',
            ),
            array(
                'name' => 'ip',
                'type' => 'raw',
                'value' => 'long2ip($data->ip)',
            ),
            'user',
            array(
                'name' => 'primary_printer',
                'value' => '(isset($data->primaryPrinter->printer_name)) ? $data->primaryPrinter->printer_name : ""'
            ),
            array(
                'header' => 'Картриджи',
                'filter' => false,
                'value' => '(isset($data->primary_printer)) ? implode(" | ",
                CHtml::listData(
                    PrinterCartridge::model()
                    ->with("idCartridge")
                    ->findAll("id_printer=".$data->primary_printer),
                        "id_cartridge", "idCartridge.cartridge_name"
                    )
                ) : ""'

            ),
            array(
                'class' => 'CButtonColumn',
                'visible' => (Yii::app()->user->isGuest) ? false : true,
            ),

        ),
    )
);

//
//var_dump(
//    CHtml::listData(
//        PrinterCartridge::model()->with('idCartridge')->findAll('id_printer=15'),
//        'id_cartridge',
//        'idCartridge.cartridge_name'
//    )
//);
