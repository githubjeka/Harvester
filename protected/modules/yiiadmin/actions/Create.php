<?php

class Create extends CAction {

    public function run() {
      
        $model_name=(string)$_GET['model_name']; 
        $model=$this->controller->module->loadModel($model_name);

        if (Yii::app()->request->isPostRequest)
        {
            if (isset($_POST[$model_name]))
                $model->attributes=$_POST[$model_name];

            if ($model->validate())
            {
                if($model->save())
                  Yii::app()->user->setFlash('flashMessage', YiiadminModule::t('Запись создана.'));
                $this->controller->redirectUser($model_name,$primaryKey);
            }
        }

        $title=YiiadminModule::t( 'Создать').' '.$this->controller->module->getObjectPluralName($model, 0);
         
        $this->controller->breadcrumbs=array(
          $this->controller->module->getModelNamePlural($model)=>$this->controller->createUrl('manageModel/list',array('model_name'=>$model_name)),
          $title
        );

        $this->controller->render('create', 
          array(
            'title'=>$title,
            'model'=>$model,            
          )
        );
    }
}
?>
