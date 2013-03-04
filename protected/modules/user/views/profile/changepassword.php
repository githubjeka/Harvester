<h2><?php echo UserModule::t("Change password"); ?></h2>

<div class="form">
<?php $form=$this->beginWidget('UActiveForm', array(
	'id'=>'changepassword-form',
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array('class'=>'nice custom'),	
)); ?>

	<?php echo CHtml::errorSummary($model,null,null,$htmlOptions=array('class'=>'alert-box four')); ?>
	
	<div class="row">
	Новый пароль
	<?php echo $form->passwordField($model,'password',array('class'=>'input-text')); ?>
	<?php echo $form->error($model,'password',$htmlOptions=array('class'=>'alert-box error four')); ?>	
	</div>
	
	<div class="row">
	Новый пароль ещё раз
	<?php echo $form->passwordField($model,'verifyPassword',array('class'=>'input-text')); ?>
	<?php echo $form->error($model,'verifyPassword',$htmlOptions=array('class'=>'alert-box error four')); ?>
	</div>
	
	
	<div class="row submit">
	<?php echo CHtml::submitButton('Изменить',array('class'=>'nice large radius blue button')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->