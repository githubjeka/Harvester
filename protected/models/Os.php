<?php

/**
 * This is the model class for table "os".
 *
 * The followings are the available columns in table 'os':
 * @property integer $id
 * @property integer $comp_id
 * @property string $os_name
 * @property string $os_product_key
 * @property integer $date_install
 * @property string $Path
 *
 * The followings are the available model relations:
 * @property Computers $comp
 */
class Os extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Os the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'os';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comp_id', 'required'),
			array('comp_id', 'numerical', 'integerOnly'=>true),
			array('os_product_key, Path', 'length', 'max'=>50),
			array('os_name', 'length', 'max'=>150),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, comp_id, os_name, os_product_key, date_install, Path', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'comp' => array(self::BELONGS_TO, 'Computers', 'comp_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'comp_id' => 'Comp',
			'os_name' => 'Наименование',
			'os_product_key' => 'Серийный ключ',
			'date_install' => 'Дата установки',
			'Path' => 'Путь к папке Windows',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('comp_id',$this->comp_id);
		$criteria->compare('os_name',$this->os_name,true);
		$criteria->compare('os_product_key',$this->os_product_key,true);
		$criteria->compare('date_install',$this->date_install);
		$criteria->compare('Path',$this->Path,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function scan($COM,$IDComp,$index=1)
	{			
		$i=1;
		foreach ($COM->instancesof ( 'Win32_OperatingSystem' ) as $OperatingSystem ) {				
			if ($index==$i) {
				$this->comp_id=$IDComp;
			        $charset = 'windows-' . $OperatingSystem->CodeSet;
                                $this->os_name = iconv($charset, 'UTF-8', $OperatingSystem->Name);
				$this->os_product_key=$OperatingSystem->SerialNumber;
				$this->date_install=$OperatingSystem->InstallDate;
				$this->Path=$OperatingSystem->WindowsDirectory;				
				break;
			}
			$i++;
		}		
	}
}
