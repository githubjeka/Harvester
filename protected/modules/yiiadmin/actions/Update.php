<?php

class Update extends CAction {

    public function run($pk) {
      
        $model_name=(string)$_GET['model_name']; 
        $model=$this->controller->module->loadModel($model_name)->findByPk($_GET['pk']);

        if (Yii::app()->request->isPostRequest)
        {
            if (isset($_POST[$model_name]))
                $model->attributes=$_POST[$model_name]; 

            if ($model->validate())
            {
                $model->save();
                Yii::app()->user->setFlash('flashMessage', YiiadminModule::t('Изменения сохранены.'));
                $this->controller->redirectUser($model_name,$model->primaryKey);
            }
        }

        $title=YiiadminModule::t( 'Редактировать').' '.$this->controller->module->getObjectPluralName($model, 0);
         
        $this->controller->breadcrumbs=array(
                $this->controller->module->getModelNamePlural($model)=>$this->controller->createUrl('manageModel/list',array('model_name'=>$model_name)),
                $title
        );

        $this->controller->render('create',array(
            'title'=>YiiadminModule::t( 'Редактировать').' '.$this->controller->module->getObjectPluralName($model, 0),
            'model'=>$model,            
        ));
    }
}
?>
