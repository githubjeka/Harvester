<?php

/**
 * This is the model class for table "network_adapters".
 *
 * The followings are the available columns in table 'network_adapters':
 * @property integer $id
 * @property integer $comp_id
 * @property string $adapter_name
 * @property string $MACAddress_adapters
 * @property string $AdapterType
 * @property string $adapter_linkspeed
 *
 * The followings are the available model relations:
 * @property Computers $comp
 */
class NetworkAdapters extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return NetworkAdapters the static model class
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
		return 'network_adapters';
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
			array('comp_id, DefaultTTL', 'numerical', 'integerOnly'=>true),
			array('AdapterType, adapter_linkspeed', 'length', 'max'=>50),
			array('adapter_name', 'length', 'max'=>150),
			array('MACAddress_adapters', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, comp_id, adapter_name, DefaultIPGateway, DefaultTTL, IPSubnet, DHCPEnabled, DHCPServer, DNSDomain, MACAddress_adapters, AdapterType, adapter_linkspeed', 'safe', 'on'=>'search'),
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
			'adapter_name' => 'Наименование',
			'DefaultIPGateway' => 'Сервер шлюза',
			'DefaultTTL' => 'Время жизни пакетов (TTL)',
			'DHCPEnabled' => 'DHCP',
			'DHCPServer' => 'Сервер DHCP',
			'DNSDomain' => 'DNS корневой',
			'IPSubnet' => 'Маска подсети',
			'MACAddress_adapters' => 'MAC адрес',
			'AdapterType' => 'Тип адаптера',
			'adapter_linkspeed' => 'Скорость',
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
		$criteria->compare('adapter_name',$this->adapter_name,true);
		$criteria->compare('DefaultIPGateway',$this->DefaultIPGateway,true);
		$criteria->compare('DefaultTTL',$this->DefaultTTL,true);
		$criteria->compare('DHCPEnabled',$this->DHCPEnabled,true);
		$criteria->compare('DHCPServer',$this->DHCPServer,true);
		$criteria->compare('DNSDomain',$this->DNSDomain,true);
		$criteria->compare('IPSubnet',$this->IPSubnet,true);
		$criteria->compare('MACAddress_adapters',$this->MACAddress_adapters,true);
		$criteria->compare('AdapterType',$this->AdapterType,true);
		$criteria->compare('adapter_linkspeed',$this->adapter_linkspeed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	protected function afterFind() {
		$this->DHCPEnabled==0 ? $this->DHCPEnabled='Выключен' : $this->DHCPEnabled='Включен';
	}
	
	public function scan($COM,$IDComp)
	{			
		foreach ($COM->instancesof ( 'Win32_NetworkAdapter' ) as $NetworkAdapter ) {				
			if($NetworkAdapter->NetConnectionStatus==1 || $NetworkAdapter->NetConnectionStatus==2) {
				$this->comp_id=$IDComp;
				$this->adapter_name=$NetworkAdapter->Name;
				$this->MACAddress_adapters=$this->mac2int($NetworkAdapter->MACAddress);
				$this->AdapterType=$NetworkAdapter->AdapterType;								
				$this->adapter_linkspeed=ceil($NetworkAdapter->Speed/8/1024/1024);
				$index=$NetworkAdapter->Index;
				break;
			}			
		}
		foreach ($COM->instancesof ( 'Win32_NetworkAdapterConfiguration' ) as $AdapterConfiguration ) {				
			if($AdapterConfiguration->Index==$index) {				
				if (!isset($AdapterConfiguration->DefaultIPGateway)) {				
					foreach ($AdapterConfiguration->DefaultIPGateway as $Ip) {					
						$this->DefaultIPGateway=$Ip;
						break;
					}
				}
				$this->DefaultTTL=$AdapterConfiguration->DefaultTTL;
				$this->DHCPEnabled=$AdapterConfiguration->DHCPEnabled;
				$this->DHCPServer=$AdapterConfiguration->DHCPServer;
				$this->DNSDomain=$AdapterConfiguration->DNSDomain;
				if (!isset($AdapterConfiguration->IPSubnet)) {
					foreach ($AdapterConfiguration->IPSubnet as $IPSubnet) {					
						$this->IPSubnet=$IPSubnet;
						break;
					}
				}
				break;
			}			
		}
		
	}
	
				
	public function mac2int($mac) {
		return base_convert($mac, 16, 10);
	}
	 
	public function int2mac($int) {
		return base_convert($int, 10, 16);
	}
	
	public function int2macaddress($int) {
		$hex = base_convert($int, 10, 16);
		while (strlen($hex) < 12)
			$hex = '0'.$hex;
		return strtoupper(implode(':', str_split($hex,2)));
	}
}