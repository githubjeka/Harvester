<?php
$this->breadcrumbs=array(
	'Домены'=>array('index'),
	'Новый домен',
);

$this->menu=array(
	array('label'=>'Список доменов', 'url'=>array('index')),
	array('label'=>'Управление доменами', 'url'=>array('admin')),
);
?>

<h4>Создание домена</h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>