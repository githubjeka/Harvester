<?php

/**
 * This is the model class for table "physical_drives".
 *
 * The followings are the available columns in table 'physical_drives':
 * @property integer $id
 * @property integer $comp_id
 * @property string $model_physical_drives
 * @property string $InterfaceType_physical_drives
 * @property string $Manufacturer_physical_drives
 * @property string $MediaType_physical_drives
 * @property string $Partitions_physical_drives
 * @property string $Size_physical_drives
 *
 * The followings are the available model relations:
 * @property Computers $comp
 */
class PhysicalDrives extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PhysicalDrives the static model class
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
		return 'physical_drives';
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
			array('comp_id, TotalCylinders', 'numerical', 'integerOnly'=>true),
			array('model_physical_drives, InterfaceType_physical_drives, Manufacturer_physical_drives, MediaType_physical_drives', 'length', 'max'=>70),
			array('Partitions_physical_drives', 'length', 'max'=>3),
			array('Size_physical_drives', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, comp_id, model_physical_drives, InterfaceType_physical_drives,TotalCylinders, TotalHeads, TotalSectors, TotalTracks, TracksPerCylinder, Manufacturer_physical_drives, MediaType_physical_drives, Partitions_physical_drives, Size_physical_drives', 'safe', 'on'=>'search'),
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
			'model_physical_drives' => 'Наименование',
			'InterfaceType_physical_drives' => 'Тип интерфейса',
			'Manufacturer_physical_drives' => 'Производитель',
			'MediaType_physical_drives' => 'Тип носителя',
			'Partitions_physical_drives' => 'Разделы',
			'TotalHeads' => 'Число глав',
			'TotalCylinders' => 'Число цилиндров',			
			'TracksPerCylinder' => 'Число дорожек в цилиндре',	
			'TotalTracks' => 'Число дорожек',
			'TotalSectors' => 'Число секторов',					
			'Size_physical_drives' => 'Размер',
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
		$criteria->compare('model_physical_drives',$this->model_physical_drives,true);
		$criteria->compare('InterfaceType_physical_drives',$this->InterfaceType_physical_drives,true);
		$criteria->compare('Manufacturer_physical_drives',$this->Manufacturer_physical_drives,true);
		$criteria->compare('MediaType_physical_drives',$this->MediaType_physical_drives,true);
		$criteria->compare('Partitions_physical_drives',$this->Partitions_physical_drives,true);
		$criteria->compare('TotalCylinders',$this->TotalCylinders,true);
		$criteria->compare('TotalHeads',$this->TotalHeads,true);
		$criteria->compare('TotalSectors',$this->TotalSectors,true);
		$criteria->compare('TotalTracks',$this->TotalTracks,true);
		$criteria->compare('TracksPerCylinder',$this->TracksPerCylinder,true);		
		$criteria->compare('Size_physical_drives',$this->Size_physical_drives,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function scan($COM,$IDComp,$index=1)
	{			
		$i=1;
		foreach ($COM->instancesof ( 'Win32_DiskDrive' ) as $DiskDrive ) {				
			if ($index==$i) {
				$this->comp_id=$IDComp;
				$this->model_physical_drives=$DiskDrive->model;				
				$this->InterfaceType_physical_drives=$DiskDrive->InterfaceType;					
				$this->Manufacturer_physical_drives=$DiskDrive->Manufacturer;
				$this->Manufacturer_physical_drives = iconv('windows-1251','UTF-8', $this->Manufacturer_physical_drives);	
				$this->MediaType_physical_drives=$DiskDrive->MediaType;
				$this->Partitions_physical_drives=$DiskDrive->Partitions;
				$this->Size_physical_drives=ceil($DiskDrive->Size/1024/1024/1024);
				$this->TotalCylinders=$DiskDrive->TotalCylinders;
				$this->TotalHeads=$DiskDrive->TotalHeads;
				$this->TotalSectors=$DiskDrive->TotalSectors;
				$this->TotalTracks=$DiskDrive->TotalTracks;
				$this->TracksPerCylinder=$DiskDrive->TracksPerCylinder;
				break;
			}
			$i++;
		}				
	}
}