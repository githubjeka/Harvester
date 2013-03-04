<?php
    $this->pageTitle=$title;   
    
    /*$plugins = scandir(Yii::app()->getModule('yiiadmin')->getBasePath().'/assets/widget_plugins');
    foreach ($plugins as $plugin) {
        if ($plugin != '.' && $plugin != '..')
            $cs->registerScriptFile($this->module->assetsUrl.'/widget_plugins/'.$plugin);
    }*/   

    foreach ($model->attributeWidgets() as $attributes)
    {
      $attribute = array_shift($attributes);
      $options = $attributes;         
      $attr_string.=$attribute.',';
    }
    
    // TODO: unset primaryKey;
    $attributes=array_filter(array_unique(array_map('trim',explode(',',$attr_string))));
?>

<?php
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>get_class($model).'-id-form',
    ));
?>

<div class="container-flexible">
        <?php if($model->hasErrors()): ?>
            <p class="errornote"><?php echo YiiadminModule::t('Пожалуйста, исправьте ошибки, указанные ниже.'); ?></p>
        <?php endif; ?>
        <div class="form-container">
        <div>
        
        <fieldset class="module wide">
        <?php  
            foreach ($attributes as $attribute): 
            if( $model->tableSchema->columns[$attribute]->isPrimaryKey===true)
                continue;
        ?>
        <div class="row <?php if($model->getError($attribute)) echo 'errors'; ?>">
            <div>
                <div class="column span-4"><?php echo $form->labelEx($model,$attribute); ?></div>
                <div class="column span-flexible">
                    <?php 
                      echo $this->module->createWidget($form,$model,$attribute); 
                    ?>
                    <ul class="errorlist"><li><?php echo $form->error($model,$attribute); ?></li></ul>
                    <!-- <p class="help">Enter the same password as above, for verification.</p>-->
                </div>
            </div>
        </div>
        <?php endforeach; ?>        
        </fieldset>
                    
        <div class="module footer">
            <ul class="submit-row">
              <?php if (!$model->isNewRecord): ?>
                <li class="left delete-link-container">
                    <?php echo CHtml::link(YiiadminModule::t('Удалить'),$this->createUrl('manageModel/delete',array(
                            'model_name'=>get_class($model),
                            'pk'=>$model->primaryKey,
                        )),
                        array(
                            'class'=>'delete-link',
                            'confirm'=>YiiadminModule::t('Удалить запись ID ').$model->primaryKey.'?',
                    )); ?>
                </li> 
              <?php endif; ?>
                <li class="submit-button-container">
                    <input type="submit" value="<?php echo YiiadminModule::t('Сохранить');?>" class="default" name="_save">
                </li>
                <li class="submit-button-container">
                    <input type="submit" value="<?php echo YiiadminModule::t('Сохранить и создать новую запись');?>" name="_addanother">
                </li>
                <?php/*
                <li class="submit-button-container">
                    <input type="submit" value="<?php echo YiiadminModule::t('Сохранить и редактировать');?>" name="_continue">
                </li> 
                */?>
            </ul
            ><br clear="all">
        </div>
 
        </div>
    </div>
</div>
<?php
$this->endWidget();
?>
