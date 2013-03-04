<?php

/**
 * This is the model class for table "cd_drives".
 *
 * The followings are the available columns in table 'cd_drives':
 * @property integer $id
 * @property integer $comp_id
 * @property string $cd_drive_name
 * @property string $cd_drives_label
 * @property string $Manufacturer_cd_drives
 * @property string $Description_cd_drives
 *
 * The followings are the available model relations:
 * @property Computers $comp
 */
class CdDrives extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CdDrives the static model class
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
		return 'cd_drives';
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
			array('cd_drive_name, Manufacturer_cd_drives, Description_cd_drives', 'length', 'max'=>100),
			array('cd_drives_label', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, comp_id, cd_drive_name, Capabilities, SCSIBus, SCSILogicalUnit, SCSIPort, SCSITargetId, cd_drives_label, Manufacturer_cd_drives, Description_cd_drives', 'safe', 'on'=>'search'),
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
			'cd_drive_name' => 'Наименование',
			'Capabilities' => 'Возможности',
			'SCSIBus' => 'Шина SCSI',
			'SCSILogicalUnit' => 'Логическая единица SCSI',
			'SCSIPort' => 'Порт SCSI',
			'SCSITargetId' => 'Целевой код SCSI',
			'cd_drives_label' => 'Метка',
			'Manufacturer_cd_drives' => 'Производитель',
			'Description_cd_drives' => 'Описание',
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
		$criteria->compare('cd_drive_name',$this->cd_drive_name,true);
		$criteria->compare('Capabilities',$this->Capabilities,true);
		$criteria->compare('SCSIBus',$this->SCSIBus,true);
		$criteria->compare('SCSILogicalUnit',$this->SCSILogicalUnit,true);
		$criteria->compare('SCSIPort',$this->SCSIPort,true);
		$criteria->compare('SCSITargetId',$this->SCSITargetId,true);
		$criteria->compare('cd_drives_label',$this->cd_drives_label,true);
		$criteria->compare('Manufacturer_cd_drives',$this->Manufacturer_cd_drives,true);
		$criteria->compare('Description_cd_drives',$this->Description_cd_drives,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	protected function AfterFind() {
		$temp = explode(',',$this->Capabilities);		
		$this->Capabilities='';
		foreach ($temp as $val) {
			switch ($val) {			
				case 0:
					$this->Capabilities.='Некорректная информация. ';
					break;
				case 1:
					$this->Capabilities.='Разные. ';
					break;
				case 2:
					$this->Capabilities.='Последовательный доступ. ';
					break;
				case 3:
					$this->Capabilities.='Случайный доступ. ';
					break;
				case 4:
					$this->Capabilities.='Поддерживает запись. ';
					break;
				case 5:
					$this->Capabilities.='Шифрование. ';
					break;
				case 6:
					$this->Capabilities.='Сжатие. ';
					break;
				case 7:
					$this->Capabilities.='Поддерживает сменные носители. ';
					break;
				case 8:
					$this->Capabilities.='Ручная очистка. ';
					break;
				case 9:
					$this->Capabilities.='Автоматическая очистка. ';
					break;
				case 10:
					$this->Capabilities.='Предупреждение SMART. ';
					break;
				case 11:
					$this->Capabilities.='Поддержка двусторонних носителей. ';
					break;
				case 12:
					$this->Capabilities.='Предварительное размонтирование не требуется. ';
					break;			
			}		
		}
	}
	
	public function scan($COM,$IDComp,$index=1)
	{			
		$i=1;
		foreach ($COM->instancesof ( 'Win32_CDROMDrive' ) as $CDROMDrive ) {				
			if ($index==$i) {
				$this->comp_id=$IDComp;
				$this->cd_drive_name=$CDROMDrive->Name;
				$this->cd_drives_label=$CDROMDrive->Drive;
				foreach ($CDROMDrive->Capabilities as $Capabilities) {
					$temp[]=$Capabilities;
				}				
				$this->Capabilities=implode(',', $temp);
				unset ($Capabilities,$temp);
				$this->Manufacturer_cd_drives=$CDROMDrive->Manufacturer;
				$this->Manufacturer_cd_drives = iconv('windows-1251','UTF-8', $CDROMDrive->Manufacturer);	
				$this->Description_cd_drives=$CDROMDrive->Description;				
				$this->Description_cd_drives = iconv('windows-1251','UTF-8', $CDROMDrive->Description);	
				$this->SCSIBus=$CDROMDrive->SCSIBus;
				$this->SCSILogicalUnit=$CDROMDrive->SCSILogicalUnit;
				$this->SCSIPort=$CDROMDrive->SCSIPort;
				$this->SCSITargetId=$CDROMDrive->SCSITargetId;
				break;
			}
			$i++;
		}				
	}
}