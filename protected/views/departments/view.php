<?php
$this->breadcrumbs=array(
	'Отделы'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Список отделов', 'url'=>array('index')),
	array('label'=>'Создать новый отдел', 'url'=>array('create')),
	array('label'=>'Изменить этот отдел', 'url'=>array('update', 'id'=>$model->id)),	
	array('label'=>'Удалить этот отдел', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены что хотите удалить?')),
	array('label'=>'Управление отделами', 'url'=>array('admin')),	
);
?>

<h4>Просмотр отдела <?php echo $model->fullname; ?></h4>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'fullname',
	),
)); ?>
