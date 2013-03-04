<?php
$this->breadcrumbs=array(
	'Домены',
);

$this->menu=array(
	array('label'=>'Создать домен', 'url'=>array('create')),
	array('label'=>'Управление доменами', 'url'=>array('admin')),
	array('label'=>'Сканировать домены', 'url'=>array('ScannerAndSave')),
);
?>

<h3>Список доменов</h3>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
