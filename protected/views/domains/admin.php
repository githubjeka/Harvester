<?php
$this->breadcrumbs=array(
	'Домены'=>array('index'),
	'Управление',
);

$this->menu=array(
	array('label'=>'Список доменов', 'url'=>array('index')),
	array('label'=>'Создание домена', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('domains-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h4>Управление доменами</h4>

<?php echo CHtml::link('Расширеный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'domains-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'Name',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
