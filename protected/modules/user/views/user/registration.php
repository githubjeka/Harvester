<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Registration");
$this->breadcrumbs=array(
	UserModule::t("Registration"),
);
?>

<h4><?php echo UserModule::t("Registration"); ?></h4>

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
		<?php echo $form->error($model,'username',$htmlOptions=array('class'=>'alert-box error')); ?>
		</div>
		
		<div class="row">
		<b><?php echo $form->labelEx($model,'password'); ?></b>
		<?php echo $form->passwordField($model,'password',$htmloptions=array('class'=>'input-text','placeholder'=>"Cюда вводится пароль")); ?>
		<?php echo $form->error($model,'password',$htmlOptions=array('class'=>'alert-box error')); ?>		
		</div>
		
		<div class="row">
		<b><?php echo $form->labelEx($model,'verifyPassword'); ?></b>
		<?php echo $form->passwordField($model,'verifyPassword',$htmloptions=array('class'=>'input-text','placeholder'=>"Повтор пароля")); ?>
		<?php echo $form->error($model,'verifyPassword',$htmlOptions=array('class'=>'alert-box error')); ?>
		</div>				
	
<?php 
		$profileFields=$profile->getFields();
		if ($profileFields) {
			foreach($profileFields as $field) {
			?>
	<div class="row">
		<?php echo $form->labelEx($profile,$field->varname); ?>
		<?php 
		if ($field->widgetEdit($profile)) {
			echo $field->widgetEdit($profile);
		} elseif ($field->range) {
			echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
		} elseif ($field->field_type=="TEXT") {
			echo$form->textArea($profile,$field->varname,array('class'=>'input-text','rows'=>6, 'cols'=>50));
		} else {
			echo $form->textField($profile,$field->varname,array('class'=>'input-text','size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
		}
		 ?>
		<?php echo $form->error($profile,$field->varname,$htmlOptions=array('class'=>'alert-box error')); ?>
	</div>	
			<?php
			}
		}
?>
	<?php if (UserModule::doCaptcha('registration')): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		<?php echo $form->error($model,'verifyCode'); ?>
		
		<p class="hint"><?php echo UserModule::t("Please enter the letters as they are shown in the image above."); ?>
		<br/><?php echo UserModule::t("Letters are not case-sensitive."); ?></p>
	</div>
	<?php endif; ?>
	
	<div class="row submit">
		<?php echo CHtml::submitButton(UserModule::t("Register"),$htmlOptions=array('class'=>'button radius white nice')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
<?php endif; ?>