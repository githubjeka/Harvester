<?php
$this->breadcrumbs=array(
	'Domains'=>array('index'),
	$model->Name,
);

$this->menu=array(
	array('label'=>'Список доменов', 'url'=>array('index')),
	array('label'=>'Создать новый домен', 'url'=>array('create')),
	array('label'=>'Изменить этот домен', 'url'=>array('update', 'id'=>$model->id)),	
	array('label'=>'Удалить этот домен', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены что хотите удалить?')),
	array('label'=>'Управление доменами', 'url'=>array('admin')),	
);
?>

<h4>Просмотр домена <?php echo $model->Name; ?></h4>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'Name',
	),
)); ?>
