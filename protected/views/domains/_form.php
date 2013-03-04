<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'domains-form',
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array('class'=>'nice custom'),
)); ?>

	<?php echo $form->errorSummary($model,null,null,$htmlOptions=array('class'=>'alert-box')); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Name'); ?>
		<?php echo $form->textField($model,'Name',array('size'=>60,'maxlength'=>63,'class'=>'input-text')); ?>
		<?php echo $form->error($model,'Name',$htmlOptions=array('class'=>'alert-box error')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Изменить',array('class'=>'button nice small')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->