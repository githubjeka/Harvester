<?php
/* @var $this CartridgesController */
/* @var $model Cartridges */

$this->menu=array(
	array('label'=>'Создать картридж', 'url'=>array('create')),
	array('label'=>'Управление картриджами', 'url'=>array('admin')),
);
?>

<h1>Редактирование картриджа № <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>