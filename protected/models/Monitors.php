<?php

/**
 * This is the model class for table "monitors".
 *
 * The followings are the available columns in table 'monitors':
 * @property integer $id
 * @property integer $comp_id
 * @property string $monitor_name
 * @property string $MonitorManufacturer
 * @property integer $ScreenHeight_monitors
 * @property integer $ScreenWidth_monitors
 *
 * The followings are the available model relations:
 * @property Computers $comp
 */
class Monitors extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Monitors the static model class
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
		return 'monitors';
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
			array('comp_id, ScreenHeight_monitors, Bandwidth, ScreenWidth_monitors', 'numerical', 'integerOnly'=>true),
			array('monitor_name, MonitorManufacturer', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, comp_id, monitor_name,Bandwidth, MonitorManufacturer, ScreenHeight_monitors, ScreenWidth_monitors', 'safe', 'on'=>'search'),
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
			'monitor_name' => 'Наименование',
			'MonitorManufacturer' => 'Производитель',
			'Bandwidth' => 'Пропускная способность',
			'ScreenHeight_monitors' => 'Высота разрешения',
			'ScreenWidth_monitors' => 'Ширина разрешения',
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
		$criteria->compare('monitor_name',$this->monitor_name,true);
		$criteria->compare('MonitorManufacturer',$this->MonitorManufacturer,true);
		$criteria->compare('Bandwidth',$this->Bandwidth,true);
		$criteria->compare('ScreenHeight_monitors',$this->ScreenHeight_monitors);
		$criteria->compare('ScreenWidth_monitors',$this->ScreenWidth_monitors);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function scan($COM,$IDComp,$index=1)
	{			
		$i=1;
		foreach ($COM->instancesof ( 'Win32_DesktopMonitor' ) as $DesktopMonitor ) {				
			if ($index==$i) {
				$this->comp_id=$IDComp;
				$this->monitor_name=$DesktopMonitor->Name;				
				$this->monitor_name = iconv('windows-1251','UTF-8', $this->monitor_name);		
				$this->MonitorManufacturer=$DesktopMonitor->MonitorManufacturer;
				$this->MonitorManufacturer = iconv('windows-1251','UTF-8', $this->MonitorManufacturer);	
				$this->Bandwidth=$DesktopMonitor->Bandwidth;
				$this->ScreenHeight_monitors=$DesktopMonitor->ScreenHeight;
				$this->ScreenWidth_monitors=$DesktopMonitor->ScreenWidth;
				break;
			}
			$i++;
		}				
	}
}