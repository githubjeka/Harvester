<?php

/**
 * This is the model class for table "printer_cartridge".
 *
 * The followings are the available columns in table 'printer_cartridge':
 * @property string $id_relation
 * @property integer $id_printer
 * @property string $id_cartridge
 *
 * The followings are the available model relations:
 * @property Printers $idPrinter
 * @property Cartridges $idCartridge
 */
class PrinterCartridge extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return PrinterCartridge the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'printer_cartridge';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_printer, id_cartridge', 'required'),
            array('id_printer', 'numerical', 'integerOnly' => true),
            array('id_cartridge', 'length', 'max' => 10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_relation, id_printer, id_cartridge', 'safe', 'on' => 'search'),
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
            'idPrinter' => array(self::BELONGS_TO, 'Printers', 'id_printer'),
            'idCartridge' => array(self::BELONGS_TO, 'Cartridges', 'id_cartridge'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_relation' => 'Id Relation',
            'id_printer' => 'Id Printer',
            'id_cartridge' => 'Id Cartridge',
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

        $criteria = new CDbCriteria;

        $criteria->compare('id_relation', $this->id_relation, true);
        $criteria->compare('id_printer', $this->id_printer);
        $criteria->compare('id_cartridge', $this->id_cartridge, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }


    public function addRelation($idPrinter = null, $idCartridges = array())
    {
        if (!empty($idPrinter) && is_array($idCartridges)) {
            $this->deleteAll('id_printer=' . $idPrinter);
            foreach ($idCartridges as $cartridgeId) {
                if (empty($cartridgeId)) {
                    return true;
                } else {
                    $relationPrinterCartridge = new PrinterCartridge;
                    $relationPrinterCartridge->id_cartridge = $cartridgeId;
                    $relationPrinterCartridge->id_printer = $idPrinter;
                    $relationPrinterCartridge->save();
                }
            }
        }
        return false;
    }
}