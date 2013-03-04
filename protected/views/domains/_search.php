<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'nice custom'),
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('class'=>'input-text')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Name'); ?>
		<?php echo $form->textField($model,'Name',array('size'=>60,'maxlength'=>63,'class'=>'input-text')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Поиск',array('class'=>'button nice small')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->