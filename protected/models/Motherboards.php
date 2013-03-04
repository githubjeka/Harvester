<?php

/**
 * This is the model class for table "motherboards".
 *
 * The followings are the available columns in table 'motherboards':
 * @property integer $id
 * @property integer $comp_id
 * @property string $board_name
 * @property string $Manufacturer_motherboards
 * @property string $SerialNumber_motherboards
 * @property string $Version_motherboards
 *
 * The followings are the available model relations:
 * @property Computers $comp
 */
class Motherboards extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Motherboards the static model class
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
		return 'motherboards';
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
			array('board_name', 'length', 'max'=>50),
			array('Manufacturer_motherboards, SerialNumber_motherboards', 'length', 'max'=>255),
			array('Version_motherboards', 'length', 'max'=>60),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, comp_id, board_name, Manufacturer_motherboards, SerialNumber_motherboards, Version_motherboards', 'safe', 'on'=>'search'),
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
			'board_name' => 'Модель',
			'Manufacturer_motherboards' => 'Производитель',
			'SerialNumber_motherboards' => 'Серийный номер',
			'Version_motherboards' => 'Версия',
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
		$criteria->compare('board_name',$this->board_name,true);
		$criteria->compare('Manufacturer_motherboards',$this->Manufacturer_motherboards,true);
		$criteria->compare('SerialNumber_motherboards',$this->SerialNumber_motherboards,true);
		$criteria->compare('Version_motherboards',$this->Version_motherboards,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function scan($COM,$IDComp)
	{				
		foreach ($COM->instancesof ( 'Win32_BaseBoard' ) as $BaseBoard ) {
			$this->comp_id=$IDComp;
			$this->board_name=$BaseBoard->Product;
			$this->Manufacturer_motherboards=$BaseBoard->Manufacturer;
			$this->SerialNumber_motherboards=$BaseBoard->SerialNumber;			
			$this->Version_motherboards=$BaseBoard->Version;			
			break;			
		}		
	}
}