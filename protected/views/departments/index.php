<?php
$this->breadcrumbs=array(
	'Отделы',
);

$this->menu=array(
	array('label'=>'Создать отдел', 'url'=>array('create')),
	array('label'=>'Управление отделами', 'url'=>array('admin')),
);
?>

<h4>Список отделов</h4>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
