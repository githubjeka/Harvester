<?php
$this->breadcrumbs=array(
	'Отделы'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Редактирование',
);

$this->menu=array(
	array('label'=>'Список отделов', 'url'=>array('index')),
	array('label'=>'Создать новый отдел', 'url'=>array('create')),
	array('label'=>'Просмотреть этот отдел', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление отделами', 'url'=>array('admin')),
);
?>

<h4>Изменение отдела <?php echo $model->fullname; ?></h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>