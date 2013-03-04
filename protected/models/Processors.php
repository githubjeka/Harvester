<?php

/**
 * This is the model class for table "processors".
 *
 * The followings are the available columns in table 'processors':
 * @property integer $id
 * @property integer $comp_id
 * @property string $processor_name
 * @property string $processor_socket_designation
 * @property integer $processor_speed
 * @property integer $MaxClockSpeed_processors
 * @property integer $ExtClock_processors
 * @property integer $Level_processors
 * @property string $Description_processors
 * @property string $Manufacturer_processors
 * @property string $Status_processors
 * @property integer $L2CacheSize_processors
 * @property integer $L2CacheSpeed_processors
 * @property string $CurrentVoltage_processors
 * @property integer $num_proc
 */
class Processors extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Processors the static model class
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
		return 'processors';
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
			array('comp_id, processor_speed, MaxClockSpeed_processors, ExtClock_processors, Level_processors, L2CacheSize_processors, L2CacheSpeed_processors, L3CacheSize,L3CacheSpeed, num_proc', 'numerical', 'integerOnly'=>true),
			array('processor_name, processor_socket_designation, Description_processors, Manufacturer_processors', 'length', 'max'=>50),
			array('Status_processors', 'length', 'max'=>2),
			array('CurrentVoltage_processors', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, comp_id, processor_name, Architecture, DataWidth, processor_socket_designation, processor_speed, MaxClockSpeed_processors, ExtClock_processors, Level_processors, Description_processors, Manufacturer_processors, Status_processors, Stepping, L2CacheSize_processors, L2CacheSpeed_processors, L3CacheSize, L3CacheSpeed, CurrentVoltage_processors, Version, num_proc', 'safe', 'on'=>'search'),
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
			'processor_name' => 'Наименование',
			'Architecture' => 'Архитектура',
			'DataWidth' => 'Разрядность',
			'processor_socket_designation' => 'Разъем',
			'processor_speed' => 'Текущая частота',
			'MaxClockSpeed_processors' => 'Максимальная частота',
			'ExtClock_processors' => 'Частота шины',
			'Level_processors' => 'Множитель',
			'Description_processors' => 'Описание',
			'Manufacturer_processors' => 'Производитель',
			'Status_processors' => 'Статус процессора',
			'Stepping' => 'Степпинг',
			'L2CacheSize_processors' => 'Размер кеша 2 уровня',
			'L2CacheSpeed_processors' => 'Частота кеша 2 уровня',			
			'L3CacheSize' => 'Размер кеша 3 уровня',
			'L3CacheSpeed' => 'Частота кеша 3 уровня',
			'CurrentVoltage_processors' => 'Напряжение ядра',
			'Version' => 'Версия выпуска',
			'num_proc' => 'Количество ядер',
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
		$criteria->compare('processor_name',$this->processor_name,true);
		$criteria->compare('Architecture',$this->Architecture,true);
		$criteria->compare('DataWidth',$this->DataWidth,true);
		$criteria->compare('processor_socket_designation',$this->processor_socket_designation,true);
		$criteria->compare('processor_speed',$this->processor_speed);
		$criteria->compare('MaxClockSpeed_processors',$this->MaxClockSpeed_processors);
		$criteria->compare('ExtClock_processors',$this->ExtClock_processors);
		$criteria->compare('Level_processors',$this->Level_processors);
		$criteria->compare('Description_processors',$this->Description_processors,true);
		$criteria->compare('Manufacturer_processors',$this->Manufacturer_processors,true);
		$criteria->compare('Status_processors',$this->Status_processors,true);
		$criteria->compare('Stepping',$this->Stepping,true);
		$criteria->compare('L2CacheSize_processors',$this->L2CacheSize_processors);
		$criteria->compare('L2CacheSpeed_processors',$this->L2CacheSpeed_processors);
		$criteria->compare('L3CacheSize',$this->L3CacheSize);
		$criteria->compare('L3CacheSpeed',$this->L3CacheSpeed);
		$criteria->compare('CurrentVoltage_processors',$this->CurrentVoltage_processors,true);
		$criteria->compare('Version',$this->Version,true);
		$criteria->compare('num_proc',$this->num_proc);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	protected function AfterFind() {
		switch ($this->Architecture) {
			case 0:
				$this->Architecture='x86';
				break;
			case 1:
				$this->Architecture='MIPS';
				break;
			case 2:
				$this->Architecture='Alpha';
				break;
			case 3:
				$this->Architecture='PowerPC';
				break;
			case 6:
				$this->Architecture='Itanium-based systems';
				break;
			case 9:
				$this->Architecture='x64';
				break;				
		}
	}
	
	
	public function scan($COM,$IDComp)
	{
		$np=0;
		foreach ($COM->instancesof ( 'Win32_Processor' ) as $proc ) {
			++$np;
		}
		
		foreach ($COM->instancesof ( 'Win32_Processor' ) as $proc ) {
			$this->comp_id=$IDComp;
			$this->processor_name=$proc->Name;
			$this->Architecture=$proc->Architecture;
			$this->DataWidth=$proc->DataWidth;
			$this->processor_socket_designation=$proc->SocketDesignation;
			$this->processor_speed=$proc->CurrentClockSpeed;
			$this->MaxClockSpeed_processors=$proc->MaxClockSpeed;
			$this->ExtClock_processors=$proc->ExtClock;
			if (!empty($this->ExtClock_processors))
				$this->Level_processors=floor($this->processor_speed/$this->ExtClock_processors);	
			$this->Description_processors=$proc->Description; 
			$this->Manufacturer_processors=$proc->Manufacturer;
			$this->Status_processors=$proc->Status;
			$this->Stepping=$proc->Stepping;
			$this->L2CacheSize_processors=$proc->L2CacheSize;
			$this->L2CacheSpeed_processors=$proc->L2CacheSpeed;
			if (isset($proc->L3CacheSize)) {
				$this->L3CacheSpeed=$proc->L3CacheSpeed;
				$this->L3CacheSize=$proc->L3CacheSize;
			}
			$this->CurrentVoltage_processors=$proc->CurrentVoltage/10;			
			$this->Version='('.$proc->Revision.') '.$proc->Version;	
			$this->Version = iconv('windows-1251','UTF-8', '('.$proc->Revision.') '.$proc->Version);			
			$this->num_proc=$np;
			break;			
		}		
	}
	
	public function findTop($Best=true) {
		$model=$this->findAll(array(
			'select'=>'comp_id, processor_speed, num_proc',			
		));
		$array=array();
		foreach ($model as $mas) {
			if (empty($array[$mas->comp_id]))
				$array[$mas->comp_id]=$mas->processor_speed*$mas->num_proc;									
		}
		unset($mas,$model);
		
		($Best) ? asort($array) : arsort($array);
			
		$array=array_slice($array,0,10,TRUE);		
		
		$topProcessors=array();
		foreach ($array as $key=>$val) {			
			$topProcessors[$key]['compname']=Computers::model()->findByPK($key)->name;
			$topProcessors[$key]['speedProcessors']=$val;
		}
		return $topProcessors;
	}
}