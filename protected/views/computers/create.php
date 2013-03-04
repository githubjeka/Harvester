<?php
$this->breadcrumbs=array(
	'Компьютеры'=>array('index'),
	'Создание',
);
?>

<h4>Создание нового компьютера</h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>