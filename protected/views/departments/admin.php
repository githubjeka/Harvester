<?php
$this->breadcrumbs=array(
	'Отделы'=>array('index'),
	'Управление',
);

$this->menu=array(
	array('label'=>'Создать отдел', 'url'=>array('create')),
	array('label'=>'Управление отделами', 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('departments-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h4>Управление отделами</h4>


<?php echo CHtml::link('Расширеный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'departments-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'fullname',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
