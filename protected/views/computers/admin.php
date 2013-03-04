<?php
$this->breadcrumbs=array(
	'Компьютеры'=>array('index'),
	'Администрирование',
);

$this->menu=array(
	array('label'=>'Список компьютеров', 'url'=>array('index')),
	array('label'=>'Создать компьютер', 'url'=>array('create')),
	array('label'=>'Компьютеры онлайн', 'url'=>array('scanner')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('computers-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h4>Администрирование компьютерами</h4>

<div class="alert-box">
Можно ввести оператор сравнения (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) в начале каждого из значений поиска, чтобы указать, как сравнение должно быть сделано.
</div>

<?php echo CHtml::link('Расширеный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'computers-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'ip',
		'Domain',
		'Department',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
