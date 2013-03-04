<?php
/* @var $this CartridgesController */
/* @var $model Cartridges */

$this->menu=array(
	array('label'=>'Добавить новый', 'url'=>array('create')),
);

?>

<h1>Управление картриджами</h1>

<p>
В поиске можно использовать логические операции (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
или <b>=</b>)
</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cartridges-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'cartridge_name',
		'count',
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update} {delete}',
		),
	),
)); ?>
