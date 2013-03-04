<?php

/**
 * This is the model class for table "BIOS".
 *
 * The followings are the available columns in table 'BIOS':
 * @property integer $id
 * @property integer $comp_id
 * @property string $BIOS_name
 * @property string $Manufacturer_BIOS
 * @property integer $ReleaseDate_BIOS
 * @property string $SMBIOSBIOSVersion
 * @property string $SerialNumber_BIOS
 *
 * The followings are the available model relations:
 * @property Computers $comp
 */
class BIOS extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BIOS the static model class
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
		return 'BIOS';
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
			array('BIOS_name, Manufacturer_BIOS, SMBIOSBIOSVersion, SerialNumber_BIOS', 'length', 'max'=>70),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, comp_id, BIOS_name, Manufacturer_BIOS, ReleaseDate_BIOS, SMBIOSBIOSVersion, SerialNumber_BIOS', 'safe', 'on'=>'search'),
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
			'BIOS_name' => 'Наименование',
			'Manufacturer_BIOS' => 'Производитель',
			'ReleaseDate_BIOS' => 'Дата выпуска',
			'SMBIOSBIOSVersion' => 'Версия SMBIOSBIOS',
			'SerialNumber_BIOS' => 'Серийный номер',
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
		$criteria->compare('BIOS_name',$this->BIOS_name,true);
		$criteria->compare('Manufacturer_BIOS',$this->Manufacturer_BIOS,true);
		$criteria->compare('ReleaseDate_BIOS',$this->ReleaseDate_BIOS);
		$criteria->compare('SMBIOSBIOSVersion',$this->SMBIOSBIOSVersion,true);
		$criteria->compare('SerialNumber_BIOS',$this->SerialNumber_BIOS,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}	
	
	public function scan($COM,$IDComp,$index=1)
	{			
		$i=1;
		foreach ($COM->instancesof ( 'Win32_BIOS' ) as $BIOS ) {				
			if ($index==$i) {
			$this->comp_id=$IDComp;
			$this->BIOS_name=$BIOS->Name;
			$this->Manufacturer_BIOS=$BIOS->Manufacturer;
			$this->ReleaseDate_BIOS=$BIOS->ReleaseDate;
			$this->SMBIOSBIOSVersion=$BIOS->SMBIOSBIOSVersion;			
			$this->SerialNumber_BIOS=$BIOS->SerialNumber;			
			break;		
			}
			$i++;
		}		
	}	
}