<?php
/* @var $this CartridgesController */
/* @var $model Cartridges */

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
	array('label'=>'Добавить новый', 'url'=>array('create')),
	array('label'=>'Изменить', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
        'confirm'=>'Уверены, что хотите удалить?')),
	array('label'=>'Управление картриджами', 'url'=>array('admin')),
);
?>

<h1>Просмотр картриджа №<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'cartridge_name',
		'count',
	),
)); ?>
