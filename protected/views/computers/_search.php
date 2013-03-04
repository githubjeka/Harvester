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
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>20,'maxlength'=>20,'class'=>'input-text')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ip'); ?>
		<?php echo $form->textField($model,'ip',array('size'=>11,'maxlength'=>11,'class'=>'input-text')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Domain'); ?>
		<?php echo $form->textField($model,'Domain',array('size'=>60,'maxlength'=>63,'class'=>'input-text')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Department'); ?>
		<?php echo $form->textField($model,'Department',array('size'=>50,'maxlength'=>50,'class'=>'input-text')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Поиск',array('class'=>'button nice small white')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->