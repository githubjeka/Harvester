<?php
class ComputersController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array(
                'allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view','setResultsPerPage'),
                'users' => array('*'),
                'ips' => Yii::app()->params['ip_access'],
            ),
            array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array(
                    'create',
                    'update',
                    'scanner',
                    'ScanComputer',
                    'Ajaxupdate',
                    'SuggestDepartments',
                    'FindComputer',
                    'Showdown',
                    'Reboot',
					'delete',
                ),
                'users' => array('@'),
            ),
            array(
                'allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin','ShowServices'),
                'users' => array('admin'),
            ),
            array(
                'deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id);

        $this->render(
            'view',
            array(
                'model' => $model,
                'processors' => $model->processors,
                'motherboards' => $model->motherboards,
                'bIOSes' => $model->bIOSes,
                'cdDrives' => $model->cdDrives,
                'memories' => $model->memories,
                'PhysicalDrives' => $model->physicalDrives,
                'soundDevices' => $model->soundDevices,
                'monitors' => $model->monitors,
                'Input_Devices' => $model->inputDevices,
                'networkAdapters' => $model->networkAdapters,
                'oses' => $model->oses,
                'printers' => $model->printers,
                'videoadapters' => $model->videoadapters,
            )
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $this->layout = '//layouts/column1';

        $model = new Computers;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Computers'])) {
            $printer_name = $_POST['Computers']['primary_printer'];
            if (!empty($printer_name)) {
                $_POST['Computers']['primary_printer'] = null;
                $model->attributes = $_POST['Computers'];
                $model->save();
                $printer = new Printers;
                $printer->comp_id = $model->id;
                $printer->printer_name = $printer_name;
                $printer->save();
                $model->primary_printer = $printer->id;
                $model->update();
                if (!empty($_POST['Cartridges']['id'])){
                    PrinterCartridge::model()->addRelation($printer->id,$_POST['Cartridges']['id']);
                }
                $this->redirect(array('view', 'id' => $model->id));
            } else {
                $model->attributes = $_POST['Computers'];
                if ($model->save()) {
                    $this->redirect(array('view', 'id' => $model->id));
                }
            }
        }

        $this->render(
            'create',
            array(
                'model' => $model,
            )
        );
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $this->layout = '//layouts/column1';

        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Computers'])) {
            $model->attributes = $_POST['Computers'];
            if ($model->save()) {
                if (!empty($_POST['Cartridges']['id'])){
                    PrinterCartridge::model()->addRelation($model->primary_printer,$_POST['Cartridges']['id']);
                }
                $this->redirect(array('index'));
            }
        }

        $this->render(
            'update',
            array(
                'model' => $model,
            )
        );
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
            }
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    function actionWork(){
        $model = $this->loadUser();
        $this->renderPartial('//layouts/inside/_working_cities_ajax',
            array(
                'model'=>$model,
            ), array(),true, false  );

    }
    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $this->layout = '//layouts/column1';

        $model = new Computers('search');

        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Computers'])) {
            $model->attributes = $_GET['Computers'];
        }

        $this->render(
            'index',
            array(
                'model' => $model,
            )
        );
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Computers('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Computers'])) {
            $model->attributes = $_GET['Computers'];
        }

        $this->render(
            'admin',
            array(
                'model' => $model,
            )
        );
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param $id
     * @throws CHttpException
     * @internal param the $integer ID of the model to be loaded
     * @return \Computers
     */
    public function loadModel($id)
    {
        $model = Computers::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'computers-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionScanner()
    {
        $Domain = Domains::model()->scannerWithComp();
        $DomainWithComp = array();
        $online = 0;

        foreach ($Domain as $DomainName) {
            $DomainWithComp[$DomainName] = Computers::model()->scanner($DomainName);
            $online += count($DomainWithComp[$DomainName]);
        }
        unset($DomainName);

        foreach ($DomainWithComp as $DomainName => $ArrayComp) {
            foreach ($ArrayComp as $CompName) {
                $temp = Computers::model()->find('Name=:Name', array(':Name' => $CompName));
                if (!isset($temp)) {
                    $NotBDComputers[] = $CompName;
                }
            }
        }

        $this->render(
            'scan',
            array(
                'DomainWithComp' => $DomainWithComp,
                'online' => $online,
                'NotBDComputers' => $NotBDComputers,
            )
        );
    }

    public function actionScanComputer($name)
    {
        $temp = Computers::model()->find('Name=:Name', array(':Name' => $name));
        (isset($temp)) ? $model = $temp : $model = new Computers;
        if ($model->scan($name)) {
            if (Yii::app()->request->isAjaxRequest) {
                return true;
            } else {
                $this->redirect(array('view', 'id' => $model->id));
            }
        } else {
            if (Yii::app()->request->isAjaxRequest) {
                return false;
            } else {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }
        throw new CHttpException(500, 'Доступ к компьютеру ограничен');
    }

    public function actionAjaxupdate()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $Date = json_decode($_POST['Date']);
            foreach ($Date as $DomainName => $ArrayComp) {
                foreach ($ArrayComp as $CompName) {
                    if ($this::actionScanComputer($CompName)) {

                    }
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public function actionSuggestDepartments()
    {
        $res = array();
        if (isset($_GET['term'])) {
            $qtxt = "SELECT fullname FROM Departments WHERE fullname LIKE :DepartmentName";
            $command = Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":DepartmentName", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            $res = $command->queryColumn();
        }

        echo CJSON::encode($res);
        Yii::app()->end();

    }

    public function actionFindComputer()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $res = array();
            if (isset($_GET['term'])) {
                $qtxt = "SELECT INET_NTOA(ip) FROM Computers WHERE INET_NTOA(ip) LIKE :text or name LIKE :text";
                $command = Yii::app()->db->createCommand($qtxt);
                $command->bindValue(":text", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
                $res = $command->queryColumn();
            }
            echo CJSON::encode($res);
            Yii::app()->end();
        } else {
            $this->redirect(array('site/menu'));
        }
    }

    public function actionShowdown($computer)
    {

    }

    public function actionReboot($computer)
    {

    }

    public function actionSetResultsPerPage($rowPerPage=10)
    {
        if (Yii::app()->user->isGuest) {
            Yii::app()->request->cookies['rowPerPage'] = new CHttpCookie('rowPerPage', $rowPerPage);
        } else {
            $user = User::model()->find("id=".Yii::app()->user->id);
            $user->rowPerPage = (int) $rowPerPage;
            $user->save('rowPerPage');
        }
    }

    public function actionShowServices($comp='')
    {
        $objLocator = new COM("WbemScripting.SWbemLocator");

        if ($comp == '') {
            $objService = $objLocator->ConnectServer();
        } else {
            $objService = $objLocator->ConnectServer(
                $comp,
                "root\cimv2",
                'admin_vts',
                'Vts_adm0',
                "MS_409",
                "ntlmdomain:ViTTS"
            );
        }


        foreach ($objService->instancesof('Win32_Process') as $propItem) {

            echo $propItem->Name . '<br>';

        }
    }
}
