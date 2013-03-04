<?php
$this->breadcrumbs=array(
	'Домены'=>array('index'),
	$model->Name=>array('view','id'=>$model->id),
	'Редактирование',
);

$this->menu=array(
	array('label'=>'Список доменов', 'url'=>array('index')),
	array('label'=>'Создать новый домен', 'url'=>array('create')),
	array('label'=>'Просмотреть этот домен', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление доменами', 'url'=>array('admin')),
);
?>

<h4>Изменение домена <?php echo $model->Name; ?></h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>