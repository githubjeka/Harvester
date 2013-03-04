<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Registration");
$this->breadcrumbs=array(
	UserModule::t("Registration"),
);
?>
<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'js/javascripts/foundation.js');?>
<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'js/javascripts/app.js');?>	
<h4><?php echo UserModule::t("Registration"); ?></h4>
<div class="panel">
	<?php if(Yii::app()->user->hasFlash('registration')): ?>
	<div class="success">
	<?php echo Yii::app()->user->getFlash('registration'); ?>
	</div>
	<?php else: ?>

	<div class="form">
	<?php $form=$this->beginWidget('UActiveForm', array(
		'id'=>'registration-form',
		'enableAjaxValidation'=>true,
		'disableAjaxValidationAttributes'=>array('RegistrationForm_verifyCode'),
		'htmlOptions' => array('enctype'=>'multipart/form-data','class'=>'custom nice'),	
	)); ?>
		
		<?php echo $form->errorSummary(array($model,$profile)); ?>
				
		<div class="row">
		<b><?php echo $form->labelEx($model,'username'); ?></b>
		<?php echo $form->textField($model,'username',$htmloptions=array('class'=>'input-text','placeholder'=>"Сюда вводится логин")); ?>
		<?php echo $form->error($model,'username'); ?>
		</div>
		
		<div class="row">
		<b><?php echo $form->labelEx($model,'password'); ?></b>
		<?php echo $form->passwordField($model,'password',$htmloptions=array('class'=>'input-text','placeholder'=>"Cюда вводится пароль")); ?>
		<?php echo $form->error($model,'password'); ?>		
		</div>
		
		<div class="row">
		<b><?php echo $form->labelEx($model,'verifyPassword'); ?></b>
		<?php echo $form->passwordField($model,'verifyPassword',$htmloptions=array('class'=>'input-text','placeholder'=>"Повтор пароля")); ?>
		<?php echo $form->error($model,'verifyPassword'); ?>
		</div>
		
		<div class="row">
		<b><?php echo $form->labelEx($model,'email'); ?></b>
		<?php echo $form->textField($model,'email',$htmloptions=array('class'=>'input-text','placeholder'=>"Еmail нужен для активизации")); ?>
		<?php echo $form->error($model,'email'); ?>
		</div>
		
		<?php if (UserModule::doCaptcha('registration')): ?>
		<div class="row">
			<b><?php echo $form->labelEx($model,'verifyCode'); ?></b>		
			
			<?php echo $form->textField($model,'verifyCode',$htmloptions=array('class'=>'input-text','placeholder'=>UserModule::t("Please enter the letters as they are shown in the image above."))); ?>
			<?php $this->widget('CCaptcha'); ?>
			<?php echo $form->error($model,'verifyCode'); ?>	
			
		</div>
		<?php endif; ?>
		
		<div class="row submit">
			<?php echo CHtml::submitButton(UserModule::t("Register"),$htmlOptions=array('class'=>'button radius white nice')); ?>
		</div>

	<?php $this->endWidget(); ?>
	</div><!-- form -->
	<?php endif; ?>
</div>