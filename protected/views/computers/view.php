<?php
$this->breadcrumbs = array(
    'Компьютеры' => array('index'),
    'Информация по компьютеру ' . $model->name,
);
if (!Yii::app()->user->isGuest) {

    $this->menu = array(
        array(
            'label' => 'Обновить по сети',
            'url' => array(
                'ScanComputer',
                'name' => $model->name
            )
        ),
        array('label' => 'Изменить', 'url' => array('update', 'id' => $model->id)),
        array(
            'label' => 'Удалить',
            'url' => '#',
            'linkOptions' => array(
                'submit' => array('delete', 'id' => $model->id),
                'confirm' => 'Вы уверены, что хотите удалить запись об этом компьютере?'
            )
        ),
    );
}
?>
<h3 class="subheader"><?php echo $model->name ?></h3>
<ul class="tabs-content">
<li id="simple1Tab" class="active">

    <h4> Общая информация </h4>
    <?php $this->widget(
    'zii.widgets.CDetailView',
    array(
        'data' => $model,
        'attributes' => array(
            'name',
            'inventar_number',
            array(
                'name' => 'ip',
                'type' => 'raw',
                'value' => long2ip($model->ip),
            ),
            'DomainName',
            'Department',
            'user',
        ),
    )
);
    ?>
    <h4> Операционная система </h4> <?php
    foreach ($oses as $os) {
        $this->widget(
            'zii.widgets.CDetailView',
            array(
                'data' => $os,
                'attributes' => array(
                    'os_name',
                    'os_product_key',
                    'date_install',
                    'Path',
                ),
            )
        );
    }
    ?>
</li>
<li id="simple2Tab">
    <h4> Материнская плата </h4> <?php
    foreach ($motherboards as $motherboard) {
        $this->widget(
            'zii.widgets.CDetailView',
            array(
                'data' => $motherboard,
                'attributes' => array(
                    'board_name',
                    'Manufacturer_motherboards',
                    'SerialNumber_motherboards',
                    'Version_motherboards',
                ),
            )
        );
    }
    ?>
    <h4> BIOS </h4> <?php
    foreach ($bIOSes as $BIOS) {
        $this->widget(
            'zii.widgets.CDetailView',
            array(
                'data' => $BIOS,
                'attributes' => array(
                    'BIOS_name',
                    'Manufacturer_BIOS',
                    'ReleaseDate_BIOS',
                    'SMBIOSBIOSVersion',
                    'SerialNumber_BIOS',
                ),
            )
        );
    }
    ?>
</li>
<li id="simple3Tab">
    <h4> Процессор </h4> <?php
    foreach ($processors as $processor) {
        $this->widget(
            'zii.widgets.CDetailView',
            array(
                'data' => $processor,
                'attributes' => array(
                    array(
                        'name' => 'processor_name',
                        'type' => 'raw',
                        'value' => CHtml::tag('span', array('class' => 'headerTitle'), $processor->processor_name),
                    ),
                    'Description_processors',
                    'Manufacturer_processors',
                    'Architecture',
                    'processor_socket_designation',
                    'DataWidth',
                    'Stepping',
                    array(
                        'name' => 'CurrentVoltage_processors',
                        'type' => 'raw',
                        'value' => $processor->CurrentVoltage_processors . ' Вольт',
                    ),
                    'Version',
                    array(
                        'type' => 'raw',
                        'value' => CHtml::tag('span', array('class' => 'headerTitle'), 'Ядро'),
                    ),
                    array(
                        'name' => 'processor_speed',
                        'type' => 'raw',
                        'value' => $processor->processor_speed . 'Мгц',
                    ),
                    array(
                        'name' => 'MaxClockSpeed_processors',
                        'type' => 'raw',
                        'value' => $processor->MaxClockSpeed_processors . 'Мгц',
                    ),
                    'ExtClock_processors',
                    'Level_processors',
                    'num_proc',
                    array(
                        'type' => 'raw',
                        'value' => CHtml::tag('span', array('class' => 'headerTitle'), 'Кэширование'),
                    ),
                    array(
                        'name' => 'L2CacheSize_processors',
                        'type' => 'raw',
                        'value' => $processor->L2CacheSize_processors . 'Кбайт',
                    ),
                    array(
                        'name' => 'L2CacheSpeed_processors',
                        'type' => 'raw',
                        'value' => $processor->L2CacheSpeed_processors . 'Кбайт',
                    ),
                    array(
                        'name' => 'L3CacheSize',
                        'type' => 'raw',
                        'value' => !empty ($processor->L3CacheSize) ? $processor->L3CacheSize . 'Кбайт' : '',
                    ),
                    array(
                        'name' => 'L3CacheSpeed',
                        'type' => 'raw',
                        'value' => !empty ($processor->L3CacheSpeed) ? $processor->L3CacheSpeed . 'Кбайт' : '',
                    ),

                ),
            )
        );
    }
    ?>
</li>
<li id="simple4Tab">
    <h4> Жеские диски </h4> <?php
    foreach ($PhysicalDrives as $PhysicalDrive) {
        echo CHtml::openTag('p');
        $this->widget(
            'zii.widgets.CDetailView',
            array(
                'data' => $PhysicalDrive,
                'attributes' => array(
                    array(
                        'label' => CHtml::tag('span', array('class' => 'headerTitle'), 'Наименование'),
                        'type' => 'raw',
                        'value' => CHtml::tag(
                            'span',
                            array('class' => 'headerTitle'),
                            $PhysicalDrive->model_physical_drives
                        ),
                    ),
                    array(
                        'name' => 'Size_physical_drives',
                        'type' => 'raw',
                        'value' => (!empty($PhysicalDrive->Size_physical_drives)) ? $PhysicalDrive->Size_physical_drives . ' Гб' : $PhysicalDrive->Size_physical_drives,
                    ),
                    'InterfaceType_physical_drives',
                    'Manufacturer_physical_drives',
                    'MediaType_physical_drives',
                    'Partitions_physical_drives',
                    'TotalHeads',
                    'TotalCylinders',
                    'TracksPerCylinder',
                    'TotalTracks',
                    'TotalSectors',
                ),
            )
        );
        echo CHtml::closeTag('p');
    }    ?>
    <h4> Дисководы </h4> <?php
    foreach ($cdDrives as $cdDrive) {
        echo CHtml::openTag('p');
        $this->widget(
            'zii.widgets.CDetailView',
            array(
                'data' => $cdDrive,
                'attributes' => array(
                    array(
                        'label' => CHtml::tag('span', array('class' => 'headerTitle'), 'Дисковод'),
                        'type' => 'raw',
                        'value' => CHtml::tag('span', array('class' => 'headerTitle'), $cdDrive->cd_drive_name),
                    ),
                    'Manufacturer_cd_drives',
                    'cd_drives_label',
                    'Capabilities',
                    'Description_cd_drives',
                    'SCSIBus',
                    'SCSILogicalUnit',
                    'SCSIPort',
                    'SCSITargetId',
                ),
            )
        );
        echo CHtml::closeTag('p');
    }    ?>
</li>
<li id="simple5Tab">
    <h4> Память </h4> <?php
    foreach ($memories as $Memory) {
        echo CHtml::openTag('p');
        $this->widget(
            'zii.widgets.CDetailView',
            array(
                'data' => $Memory,
                'attributes' => array(
                    array(
                        'label' => CHtml::tag('span', array('class' => 'headerTitle'), 'Наименование'),
                        'type' => 'raw',
                        'value' => CHtml::tag('span', array('class' => 'headerTitle'), $Memory->model_Memory),
                    ),
                    'Manufacturer_Memory',
                    'size_Memory',
                    array(
                        'name' => 'DataWidth',
                        'type' => 'raw',
                        'value' => (!empty($Memory->DataWidth)) ? $Memory->DataWidth . ' бит' : $Memory->DataWidth,
                    ),
                    array(
                        'name' => 'TotalWidth',
                        'type' => 'raw',
                        'value' => (!empty($Memory->TotalWidth)) ? $Memory->TotalWidth . ' бит' : $Memory->TotalWidth,
                    ),
                    'FormFactor_Memory',
                    'MemoryType_Memory',
                    'Speed_Memory',
                    'BankLabel_Memory',
                ),
            )
        );
        echo CHtml::closeTag('p');
    } ?>
</li>
<li id="simple6Tab">
    <h4> Звуковые устройства </h4> <?php
    foreach ($soundDevices as $SoundDevice) {
        $this->widget(
            'zii.widgets.CDetailView',
            array(
                'data' => $SoundDevice,
                'attributes' => array(
                    'name_SoundDevice',
                    'Manufacturer_SoundDevice',
                ),
            )
        );
    }
    ?>
</li>
<li id="simple7Tab">
    <h4> Графические устройства </h4> <?php
    foreach ($monitors as $monitor) {
        echo CHtml::tag('h5', array('class' => 'headerTitle'), $monitor->monitor_name);
        $this->widget(
            'zii.widgets.CDetailView',
            array(
                'data' => $monitor,
                'attributes' => array(
                    'MonitorManufacturer',
                    'Bandwidth',
                    array(
                        'label' => 'Текущее разрешение',
                        'type' => 'raw',
                        'value' => $monitor->ScreenWidth_monitors . ' x ' . $monitor->ScreenHeight_monitors,
                    ),
                ),
            )
        );
    }

    foreach ($videoadapters as $videoadapter) {
        echo CHtml::tag('p');
        echo CHtml::tag('h5', array('class' => 'headerTitle'), $videoadapter->videoadapter_name);
        $this->widget(
            'zii.widgets.CDetailView',
            array(
                'data' => $videoadapter,
                'attributes' => array(
                    'VideoArchitecture',
                    'AdapterRAM',
                    'VideoMemoryType',
                    'AdapterCompatibility',
                    'VideoProcessor',
                    array(
                        'name' => 'AdapterDACType',
                        'type' => 'raw',
                        'value' => $videoadapter->AdapterDACType,
                    ),
                    'VideoModeDescription',
                    array(
                        'name' => 'CurrentBitsPerPixel',
                        'type' => 'raw',
                        'value' => (!empty($videoadapter->CurrentBitsPerPixel)) ? $videoadapter->CurrentBitsPerPixel . ' бит' : $videoadapter->CurrentBitsPerPixel,
                    ),
                    'CurrentScanMode',
                    'MaxRefreshRate_videoadapters',
                    'MinRefreshRate_videoadapters',
                    'InstalledDisplayDrivers',
                    'DriverVersion_videoadapters',
                    'AcceleratorCapabilities',
                ),
            )
        );
    }        ?>
</li>
<li id="simple8Tab">
    <h4> Сеть </h4> <?php
    foreach ($networkAdapters as $NetworkAdapter) {
        $this->widget(
            'zii.widgets.CDetailView',
            array(
                'data' => $NetworkAdapter,
                'attributes' => array(
                    array(
                        'label' => 'IP-адрес',
                        'type' => 'raw',
                        'value' => long2ip($model->ip),
                    ),
                    array(
                        'label' => 'Имя DNS',
                        'type' => 'raw',
                        'value' => $model->Domain,
                    ),
                    array(
                        'label' => 'Имя домена',
                        'type' => 'raw',
                        'value' => $model->DomainName,
                    ),
                    array(
                        'label' => CHtml::tag('span', array('class' => 'headerTitle'), 'Сетевой адаптер'),
                        'type' => 'raw',
                        'value' => CHtml::tag('span', array('class' => 'headerTitle'), $NetworkAdapter->adapter_name),
                    ),
                    'AdapterType',
                    'IPSubnet',
                    'DefaultIPGateway',
                    array(
                        'label' => 'DHCP',
                        'type' => 'raw',
                        'value' => $NetworkAdapter->DHCPServer . ' ' . $NetworkAdapter->DHCPEnabled,
                    ),
                    'DNSDomain',
                    array(
                        'name' => 'MACAddress_adapters',
                        'type' => 'raw',
                        'value' => NetworkAdapters::model()->int2macaddress($NetworkAdapter->MACAddress_adapters),
                    ),
                    array(
                        'name' => 'adapter_linkspeed',
                        'type' => 'raw',
                        'value' => (!empty($NetworkAdapter->adapter_linkspeed)) ? $NetworkAdapter->adapter_linkspeed . 'Мб/c' : 'Не определено',
                    ),
                    'DefaultTTL',
                ),
            )
        );
    }
    ?>
</li>
<li id="simple9Tab">
    <h4> Мышь и клавиатура </h4> <?php
    foreach ($Input_Devices as $Input_Dev) {
        echo CHtml::openTag('p');
        $this->widget(
            'zii.widgets.CDetailView',
            array(
                'data' => $Input_Dev,
                'attributes' => array(
                    'Keyboard',
                    'PointingDevice',
                ),
            )
        );
        echo CHtml::closeTag('p');
    }    ?>
    <h4> Принтеры </h4> <?php
    foreach ($printers as $printer) {
        echo CHtml::openTag('p');
        $this->widget(
            'zii.widgets.CDetailView',
            array(
                'data' => $printer,
                'attributes' => array(
                    array(
                        'label' => CHtml::tag('span', array('class' => 'headerTitle'), 'Наименование'),
                        'type' => 'raw',
                        'value' => CHtml::tag('span', array('class' => 'headerTitle'), $printer->printer_name),
                    ),
                    'PortName_printers',
                    'PrintProcessor',
                    'HorizontalResolution_printers',
                    'VerticalResolution_printers',
                    'type_printers',
                    'Capabilities',
                ),
            )
        );
        echo CHtml::closeTag('p');
    }    ?>

</li>
</ul>