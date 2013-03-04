<?php
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Login");
$this->breadcrumbs=array(
	UserModule::t("Login"),
);
?>

<h4><?php echo UserModule::t("Login"); ?></h4>

<?php if(Yii::app()->user->hasFlash('loginMessage')): ?>

<div class="success">
	<?php echo Yii::app()->user->getFlash('loginMessage'); ?>
</div>

<?php endif; ?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions'=>array('class'=>'nice custom'),
)); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('class'=>'input-text')); ?>
		<?php echo $form->error($model,'username',$htmlOptions=array('class'=>'alert-box error')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('class'=>'input-text medium')); ?>
		<?php echo $form->error($model,'password',$htmlOptions=array('class'=>'alert-box error')); ?>
	</div>

	<div class="row">
		<span class="left"><?php echo $form->checkBox($model,'rememberMe',array('class'=>'custom checkbox')); ?></span>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe',$htmlOptions=array('class'=>'alert-box error')); ?>
	</div>

	<div class="row buttons">
		<p><?php echo CHtml::submitButton('Войти',array('class'=>'nice large radius white button'));?></p>
	</div>
	
<?php $this->endWidget(); ?>
</div><!-- form -->