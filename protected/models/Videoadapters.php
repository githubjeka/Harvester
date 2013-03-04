<?php

/**
 * This is the model class for table "videoadapters".
 *
 * The followings are the available columns in table 'videoadapters':
 * @property integer $id
 * @property integer $comp_id
 * @property string $AdapterCompatibility
 * @property string $VideoProcessor
 * @property string $AdapterDACType
 * @property string $videoadapter_name
 * @property string $AdapterRAM
 * @property string $VideoModeDescription
 * @property string $InstalledDisplayDrivers
 * @property string $DriverVersion_videoadapters
 * @property string $MaxRefreshRate_videoadapters
 * @property string $MinRefreshRate_videoadapters
 *
 * The followings are the available model relations:
 * @property Computers $comp
 */
class Videoadapters extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Videoadapters the static model class
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
		return 'videoadapters';
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
			array('comp_id, AcceleratorCapabilities, CurrentBitsPerPixel', 'numerical', 'integerOnly'=>true),
			array('AdapterCompatibility, VideoProcessor, CurrentScanMode, AdapterDACType, videoadapter_name, VideoModeDescription, InstalledDisplayDrivers, DriverVersion_videoadapters', 'length', 'max'=>70),
			array('AdapterRAM', 'length', 'max'=>6),
			array('MaxRefreshRate_videoadapters, MinRefreshRate_videoadapters', 'length', 'max'=>4),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, comp_id, AcceleratorCapabilities, VideoArchitecture, VideoMemoryType, CurrentBitsPerPixel, CurrentScanMode, CapabilityDescriptions, AdapterCompatibility, VideoProcessor, AdapterDACType, videoadapter_name, AdapterRAM, VideoModeDescription, InstalledDisplayDrivers, DriverVersion_videoadapters, MaxRefreshRate_videoadapters, MinRefreshRate_videoadapters', 'safe', 'on'=>'search'),
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
			'AcceleratorCapabilities' => '3D возможности',
			'CapabilityDescriptions' => 'Описание 3D возможностей',
			'CurrentScanMode' => 'Тип развертки',
			'AdapterCompatibility' => 'Семейство',
			'VideoProcessor' => 'Процессор',
			'AdapterDACType' => 'Тип DAC (ЦАП)',
			'videoadapter_name' => 'Наименование',
			'AdapterRAM' => 'Установленная память',
			'VideoArchitecture' => 'Архитектура',
			'VideoMemoryType' => 'Тип видео памяти',
			'VideoModeDescription' => 'Текущий видеорежим',
			'CurrentBitsPerPixel' => 'Глубина цвета',
			'InstalledDisplayDrivers' => 'Драйвер',
			'DriverVersion_videoadapters' => 'Версия драйвера',
			'MaxRefreshRate_videoadapters' => 'Макс. частота обновления',
			'MinRefreshRate_videoadapters' => 'Мин. частота обновления',
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
		$criteria->compare('AcceleratorCapabilities',$this->AcceleratorCapabilities,true);
		$criteria->compare('CapabilityDescriptions',$this->CapabilityDescriptions,true);
		$criteria->compare('CurrentScanMode',$this->CurrentScanMode,true);
		$criteria->compare('AdapterCompatibility',$this->AdapterCompatibility,true);
		$criteria->compare('VideoProcessor',$this->VideoProcessor,true);
		$criteria->compare('AdapterDACType',$this->AdapterDACType,true);
		$criteria->compare('videoadapter_name',$this->videoadapter_name,true);
		$criteria->compare('AdapterRAM',$this->AdapterRAM,true);
		$criteria->compare('VideoModeDescription',$this->VideoModeDescription,true);
		$criteria->compare('VideoArchitecture',$this->VideoArchitecture,true);
		$criteria->compare('VideoMemoryType',$this->VideoMemoryType,true);
		$criteria->compare('CurrentBitsPerPixel',$this->CurrentBitsPerPixel,true);
		$criteria->compare('InstalledDisplayDrivers',$this->InstalledDisplayDrivers,true);
		$criteria->compare('DriverVersion_videoadapters',$this->DriverVersion_videoadapters,true);
		$criteria->compare('MaxRefreshRate_videoadapters',$this->MaxRefreshRate_videoadapters,true);
		$criteria->compare('MinRefreshRate_videoadapters',$this->MinRefreshRate_videoadapters,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	protected function afterFind() {
		
		if ($this->AcceleratorCapabilities==1) {
			$this->AcceleratorCapabilities='Другие: '.$this->CapabilityDescriptions;
		} elseif ($this->AcceleratorCapabilities==2) {
			$this->AcceleratorCapabilities='Графический ускоритель: '.$this->CapabilityDescriptions;
		} elseif ($this->AcceleratorCapabilities==3) {
			$this->AcceleratorCapabilities='3-D ускоритель: '.$this->CapabilityDescriptions;
		}
		
		if ($this->CurrentScanMode==1) {
			$this->CurrentScanMode='Другая';
		} elseif ($this->CurrentScanMode==3) {
			$this->CurrentScanMode='Построчная (Non-Interlaced)';
		} elseif ($this->CurrentScanMode==4) {
			$this->CurrentScanMode='Чересстрочная (Interlaced)';
		}
		
		switch ($this->VideoArchitecture) {
			case 1:
				$this->VideoArchitecture='Другое';
				break;
			case 2:
				$this->VideoArchitecture='Не определено';
				break;
			case 3:
				$this->VideoArchitecture='CGA';
				break;
			case 4:
				$this->VideoArchitecture='EGA';
				break;
			case 5:
				$this->VideoArchitecture='VGA';
				break;
			case 6:
				$this->VideoArchitecture='SVGA';
				break;
			case 7:
				$this->VideoArchitecture='MDA';
				break;
			case 8:
				$this->VideoArchitecture='HGC';
				break;
			case 9:
				$this->VideoArchitecture='MCGA';
				break;
			case 10:
				$this->VideoArchitecture='8514A';
				break;
			case 11:
				$this->VideoArchitecture='XGA';
				break;
			case 12:
				$this->VideoArchitecture='Linear Frame Buffer';
				break;
			case 160:
				$this->VideoArchitecture='PC-98';
				break;
		}
		
		switch ($this->VideoMemoryType) {
			case 1:
				$this->VideoMemoryType='Другое';
				break;
			case 2:
				$this->VideoMemoryType='Не определено';
				break;
			case 3:
				$this->VideoMemoryType='VRAM';
				break;
			case 4:
				$this->VideoMemoryType='DRAM';
				break;
			case 5:
				$this->VideoMemoryType='SRAM';
				break;
			case 6:
				$this->VideoMemoryType='WRAM';
				break;
			case 7:
				$this->VideoMemoryType='EDO RAM';
				break;
			case 8:
				$this->VideoMemoryType='Burst Synchronous DRAM';
				break;
			case 9:
				$this->VideoMemoryType='Pipelined Burst SRAM';
				break;
			case 10:
				$this->VideoMemoryType='CDRAM';
				break;
			case 11:
				$this->VideoMemoryType='3DRAM';
				break;
			case 12:
				$this->VideoMemoryType='SDRAM';
				break;
			case 13:
				$this->VideoMemoryType='SGRAM';
				break;
		}
	}

	
	public function scan($COM,$IDComp)
	{				
		foreach ($COM->instancesof ( 'Win32_VideoController' ) as $VideoController ) {
			if ($VideoController->Availability==3) {
				$this->comp_id=$IDComp;
				$this->videoadapter_name=$VideoController->Name;
				$this->AcceleratorCapabilities=$VideoController->AcceleratorCapabilities;				
				$this->CapabilityDescriptions=$VideoController->CapabilityDescriptions;				
				$this->CurrentScanMode=$VideoController->CurrentScanMode;				
				$this->AdapterCompatibility=$VideoController->AdapterCompatibility;
				$this->VideoProcessor=$VideoController->VideoProcessor;
				$this->AdapterDACType=$VideoController->AdapterDACType;
				$this->AdapterRAM=ceil($VideoController->AdapterRAM/1024/1024);
				$this->VideoModeDescription=$VideoController->VideoModeDescription;
				$this->VideoModeDescription=iconv('windows-1251','UTF-8', $VideoController->VideoModeDescription);					
				$this->CurrentBitsPerPixel=$VideoController->CurrentBitsPerPixel;
				$this->VideoArchitecture=$VideoController->VideoArchitecture;
				$this->VideoMemoryType=$VideoController->VideoMemoryType;
				$this->InstalledDisplayDrivers=$VideoController->InstalledDisplayDrivers;
				$this->DriverVersion_videoadapters=$VideoController->DriverVersion;
				$this->MaxRefreshRate_videoadapters=$VideoController->MaxRefreshRate;
				$this->MinRefreshRate_videoadapters=$VideoController->MinRefreshRate;			
				break;	
			}
		}		
	}
}