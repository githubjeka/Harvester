<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'departments-form',
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array('class'=>'nice custom'),
)); ?>

	<?php echo $form->errorSummary($model,null,null,$htmlOptions=array('class'=>'alert-box')); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>10,'maxlength'=>10,'class'=>'input-text')); ?>
		<?php echo $form->error($model,'name',$htmlOptions=array('class'=>'alert-box error')); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'fullname'); ?>
		<?php echo $form->textField($model,'fullname',array('size'=>50,'maxlength'=>50,'class'=>'input-text')); ?>
		<?php echo $form->error($model,'fullname',$htmlOptions=array('class'=>'alert-box error')); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Изменить',array('class'=>'button nice small')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->