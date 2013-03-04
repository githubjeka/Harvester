<?php
$this->breadcrumbs=array(
	'Computers'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);
?>

<h4>Редактирование информации <?php echo $model->name; ?></h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>