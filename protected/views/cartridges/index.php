<?php
/* @var $this CartridgesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cartridges',
);

$this->menu=array(
	array('label'=>'Добавить новый', 'url'=>array('create')),
	array('label'=>'Управление', 'url'=>array('admin')),
);
?>

<h1>Список картриджей</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
