<?php
/* @var $this CartridgesController */
/* @var $model Cartridges */

$this->menu=array(
	array('label'=>'Управление картриджами', 'url'=>array('admin')),
);
?>

<h1>Новый картридж</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>