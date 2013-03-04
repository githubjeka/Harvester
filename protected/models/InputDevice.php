<?php

/**
 * This is the model class for table "Input_Device".
 *
 * The followings are the available columns in table 'Input_Device':
 * @property integer $id
 * @property integer $comp_id
 * @property string $Keyboard
 * @property string $PointingDevice
 *
 * The followings are the available model relations:
 * @property Computers $comp
 */
class InputDevice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return InputDevice the static model class
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
		return 'Input_Device';
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
			array('Keyboard, PointingDevice', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, comp_id, Keyboard, PointingDevice', 'safe', 'on'=>'search'),
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
			'Keyboard' => 'Клавиатура',
			'PointingDevice' => 'Мышь',
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
		$criteria->compare('Keyboard',$this->Keyboard,true);
		$criteria->compare('PointingDevice',$this->PointingDevice,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function scan($COM,$IDComp)
	{			
		$this->comp_id=$IDComp;
		foreach ($COM->instancesof ( 'Win32_Keyboard' ) as $Device ) {				
			if($Device->Status=='OK') {
				$this->Keyboard=iconv('windows-1251','UTF-8', $Device->Name);	
				break;
			}			
		}
		foreach ($COM->instancesof ( 'Win32_PointingDevice' ) as $Device ) {				
			if($Device->Status=='OK') {
				$this->PointingDevice=iconv('windows-1251','UTF-8', $Device->Name);				
				break;
			}			
		}
			
	}
}