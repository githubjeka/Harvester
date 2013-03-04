<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");?>
<h5> Возможные действия: </h5>
<?php echo $this->renderPartial('menu'); ?>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>