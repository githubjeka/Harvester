<?php
$this->breadcrumbs=array(
	'Отделы'=>array('index'),
	'Создание',
);

$this->menu=array(
	array('label'=>'Список отделов', 'url'=>array('index')),
	array('label'=>'Управление отделами', 'url'=>array('admin')),
);
?>

<h4>Создать новый отдел</h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>