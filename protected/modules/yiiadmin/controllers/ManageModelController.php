<?php
/**
 * ManageModelController 
 * 
 * @uses YAdminController
 * @package yiiadmin
 * @version $id$
 * @copyright 2010 firstrow@gmail.com
 * @author Firstrow <firstrow@gmail.com> 
 * @license BSD
 */

/**
 * Управление данными модели. Вывод, редактирование, удаление.
**/
class ManageModelController extends YAdminController
{
    public function actionIndex()
    {

    }

    /**
     * Вывод списка записей модели.
     * 
     * @access public
     * @return void
     */
    public function actionList()
    {
        $model_name=(string)$_GET['model_name']; 
        $model=$this->module->loadModel($model_name);

        if (isset($_GET[get_class($model)]))
            $model->attributes=$_GET[get_class($model)];

        $this->breadcrumbs=array(
                $this->module->getModelNamePlural($model),
        );

        if (method_exists($model,'adminSearch'))
            $data1=$model->adminSearch();
        else
            $data1=array();

        $url_prefix='Yii::app()->createUrl("yiiadmin/manageModel/';

        $data2=array(
            'id'=>'objects-grid',
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'itemsCssClass'=>'table',
            'enablePagination'=>true,
            'pagerCssClass'=>'pagination',
            'selectableRows'=>2,
            'pager'=>array(
                'cssFile'=>false,
                'htmlOptions'=>array('class'=>'pagination'),
                'header'=>false,
            ),
            'template'=>' 
                <div class="module changelist-results">
                    {items}
                </div>
                <div class="module pagination">
                    {pager}{summary}<br clear="all">
                </div> 
            ',
            'columns'=>array(
            array(
                'class'=>'YiiAdminButtonColumn',
                'updateButtonUrl'=>$url_prefix.'update",array("model_name"=>"'.get_class($model).'","pk"=>$data->primaryKey))',
                'deleteButtonUrl'=>$url_prefix.'delete",array("model_name"=>"'.get_class($model).'","pk"=>$data->primaryKey))',
                'viewButtonUrl'=>$url_prefix.'view",array("model_name"=>"'.get_class($model).'","pk"=>$data->primaryKey))',
                'viewButtonOptions'=>array(
                    'style'=>'display:none;',
                 ),
            ),
            ),
        ); 

        $listData=array_merge_recursive($data1,$data2); 

        if (Yii::app()->request->isAjaxRequest)
        {
            $this->widget('zii.widgets.grid.CGridView',$listData); 
            Yii::app()->end();
        }

        $this->render('list_objects',array(
            'title'=>$this->module->getModelNamePlural($model),
            'model'=>$model, 
            'listData'=>$listData, 
        ));
    }

    public function actions()
    {  
      return array(
            'create'=>'yiiadmin.actions.Create',
            'delete'=>'yiiadmin.actions.Delete',
            'update'=>'yiiadmin.actions.Update',
        );
    }    

    /**
     * Redirect after editing model data.
     * 
     * @param string $model_name 
     * @param integer $pk 
     * @access protected
     * @return void
     */
    public function redirectUser($model_name,$pk)
    {
        if ($_POST['_save'])
            $this->redirect($this->createUrl('manageModel/list',array('model_name'=>$model_name)));
              
        if ($_POST['_addanother']){
            Yii::app()->user->setFlash('flashMessage', YiiadminModule::t('Изменения сохранены. Можете создать новую запись.')); 
            $this->redirect($this->createUrl('manageModel/create',array('model_name'=>$model_name)));
        }
        
        if ($_POST['_continue'])
            $this->redirect($this->createUrl('manageModel/update',array('model_name'=>$model_name,'pk'=>$pk)));
    }
}
