<?php

/**
 * This is the model class for table "Memory".
 *
 * The followings are the available columns in table 'Memory':
 * @property integer $id
 * @property integer $comp_id
 * @property string $model_Memory
 * @property integer $size_Memory
 * @property string $Manufacturer_Memory
 * @property integer $FormFactor_Memory
 * @property integer $MemoryType_Memory
 * @property integer $Speed_Memory
 * @property string $BankLabel_Memory
 *
 * The followings are the available model relations:
 * @property Computers $comp
 */
class Memory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Memory the static model class
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
		return 'Memory';
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
			array('comp_id, size_Memory, FormFactor_Memory, MemoryType_Memory, Speed_Memory', 'numerical', 'integerOnly'=>true),
			array('model_Memory, Manufacturer_Memory, BankLabel_Memory', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, comp_id, model_Memory, size_Memory, Manufacturer_Memory, DataWidth, TotalWidth, FormFactor_Memory, MemoryType_Memory, Speed_Memory, BankLabel_Memory', 'safe', 'on'=>'search'),
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
			'model_Memory' => 'Модель',
			'size_Memory' => 'Объём',
			'DataWidth' => 'Ширина потока данных',
			'TotalWidth' => 'Общая ширина данных',
			'Manufacturer_Memory' => 'Производитель',
			'FormFactor_Memory' => 'Форм-фактор',
			'MemoryType_Memory' => 'Тип',
			'Speed_Memory' => 'Частота',
			'BankLabel_Memory' => 'Метка банка',
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
		$criteria->compare('model_Memory',$this->model_Memory,true);
		$criteria->compare('size_Memory',$this->size_Memory);
		$criteria->compare('Manufacturer_Memory',$this->Manufacturer_Memory,true);
		$criteria->compare('DataWidth',$this->DataWidth,true);
		$criteria->compare('TotalWidth',$this->TotalWidth,true);
		$criteria->compare('FormFactor_Memory',$this->FormFactor_Memory);
		$criteria->compare('MemoryType_Memory',$this->MemoryType_Memory);
		$criteria->compare('Speed_Memory',$this->Speed_Memory);
		$criteria->compare('BankLabel_Memory',$this->BankLabel_Memory,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	protected function AfterFind() {
		switch ($this->FormFactor_Memory) {
			case 0:
				$this->FormFactor_Memory='Не определено';
				break;
			case 1:
				$this->FormFactor_Memory='Другое';
				break;
			case 2:
				$this->FormFactor_Memory='SIP';
				break;
			case 3:
				$this->FormFactor_Memory='DIP';
				break;
			case 4:
				$this->FormFactor_Memory='ZIP';
				break;
			case 5:
				$this->FormFactor_Memory='SOJ';
				break;
			case 6:
				$this->FormFactor_Memory='Proprietary';
				break;
			case 7:
				$this->FormFactor_Memory='SIMM';
				break;
			case 8:
				$this->FormFactor_Memory='DIMM';
				break;
			case 9:
				$this->FormFactor_Memory='TSOP';
				break;
			case 10:
				$this->FormFactor_Memory='PGA';
				break;
			case 11:
				$this->FormFactor_Memory='RIMM';
				break;
			case 12:
				$this->FormFactor_Memory='SODIMM';
				break;
			case 13:
				$this->FormFactor_Memory='SRIMM';
				break;
			case 14:
				$this->FormFactor_Memory='SMD';
				break;
			case 15:
				$this->FormFactor_Memory='SSMP';
				break;
			case 16:
				$this->FormFactor_Memory='QFP';
				break;
			case 17:
				$this->FormFactor_Memory='TQFP';
				break;
			case 18:
				$this->FormFactor_Memory='SOIC';
				break;
			case 19:
				$this->FormFactor_Memory='LCC';
				break;
			case 20:
				$this->FormFactor_Memory='PLCC';
				break;
			case 21:
				$this->FormFactor_Memory='BGA';
				break;
			case 22:
				$this->FormFactor_Memory='FPBGA';
				break;
			case 23:
				$this->FormFactor_Memory='LGA';
				break;
		}
		
		switch ($this->MemoryType_Memory) {
			case 0:
				$this->MemoryType_Memory='Не определено';
				break;
			case 1:
				$this->MemoryType_Memory='Другое';
				break;
			case 2:
				$this->MemoryType_Memory='DRAM';
				break;
			case 3:
				$this->MemoryType_Memory='Synchronous DRAM';
				break;
			case 4:
				$this->MemoryType_Memory='Cache DRAM';
				break;
			case 5:
				$this->MemoryType_Memory='EDO';
				break;
			case 6:
				$this->MemoryType_Memory='EDRAM';
				break;
			case 7:
				$this->MemoryType_Memory='VRAM';
				break;
			case 8:
				$this->MemoryType_Memory='SRAM';
				break;
			case 9:
				$this->MemoryType_Memory='RAM';
				break;
			case 10:
				$this->MemoryType_Memory='ROM';
				break;
			case 11:
				$this->MemoryType_Memory='Flash';
				break;
			case 12:
				$this->MemoryType_Memory='EEPROM';
				break;
			case 13:
				$this->MemoryType_Memory='FEPROM';
				break;
			case 14:
				$this->MemoryType_Memory='EPROM';
				break;
			case 15:
				$this->MemoryType_Memory='CDRAM';
				break;
			case 16:
				$this->MemoryType_Memory='3DRAM';
				break;
			case 17:
				$this->MemoryType_Memory='SDRAM';
				break;
			case 18:
				$this->MemoryType_Memory='SGRAM';
				break;
			case 19:
				$this->MemoryType_Memory='RDRAM';
				break;
			case 20:
				$this->MemoryType_Memory='DDR';
				break;
			case 21:
				$this->MemoryType_Memory='DDR-2';
				break;
			case 22:
				$this->MemoryType_Memory='DDR-3';
				break;			
		}
	}
	
	public function scan($COM,$IDComp,$index=1)
	{				
		$i=1;
		foreach ($COM->instancesof ( 'Win32_PhysicalMemory' ) as $Memory ) {
			if ($index==$i) {
				$this->comp_id=$IDComp;
				$this->model_Memory=$Memory->Name;
				$this->model_Memory = iconv('windows-1251','UTF-8', $this->model_Memory);	
				$this->size_Memory=$Memory->Capacity/1024/1024;
				$this->Manufacturer_Memory=$Memory->Manufacturer;			
				$this->DataWidth=$Memory->DataWidth;			
				$this->TotalWidth=$Memory->TotalWidth;			
				$this->FormFactor_Memory=$Memory->FormFactor;	
				$this->MemoryType_Memory=$Memory->MemoryType;						
				$this->Speed_Memory=$Memory->Speed;
				$this->BankLabel_Memory=$Memory->BankLabel;
				break;
			}
			$i++;
		}		
	}
	
	public function findTop($Best=true) {
		$model=$this->findAll(array(
			'select'=>'comp_id, size_Memory',			
		));
		$array=array();
		foreach ($model as $mas) {			
			if (empty($array[$mas->comp_id]))
				$array[$mas->comp_id]=$mas->size_Memory;			
			else 
				$array[$mas->comp_id]+=$mas->size_Memory;							
		}
		unset($mas,$model);
		
		($Best) ? asort($array) : arsort($array);
			
		$array=array_slice($array,0,10,TRUE);		
		
		$topMemory=array();
		foreach ($array as $key=>$val) {			
			$topMemory[$key]['compname']=Computers::model()->findByPK($key)->name;
			$topMemory[$key]['sizeMemory']=$val;
		}
		return $topMemory;
	}
}