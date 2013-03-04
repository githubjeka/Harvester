<?php
$this->breadcrumbs=array(
	UserModule::t('Users')=>array('index'),
	$model->username,
);
?>
<h1>
	<?php echo UserModule::t('View User');?> 
	<span class="subheader"><?php echo $model->username; ?></span>
</h1>
<div class="panel">
	<ul class="actions" >	
		<li><?php echo CHtml::link('Cтатьи',array('/post/AuthorPost','authID'=>$model->id)); ?></li>
	</ul><!-- actions -->

	<?php 

	// For all users
		$attributes = array(
				'username',
		);
		
		$profileFields=ProfileField::model()->forAll()->sort()->findAll();
		if ($profileFields) {
			foreach($profileFields as $field) {
				array_push($attributes,array(
						'label' => UserModule::t($field->title),
						'name' => $field->varname,
						'value' => $model->profile->getAttribute($field->varname),
					));
			}
		}
		array_push($attributes,
			array(
				'name' => 'createtime',
				'value' => date("d.m.Y H:i:s",$model->createtime),
			),
			array(
				'name' => 'lastvisit',
				'value' => (($model->lastvisit)?date("d.m.Y H:i:s",$model->lastvisit):UserModule::t('Not visited')),
			)
		);
				
		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>$attributes,
		));

	?>
</div>