<?php
 function actionIndex()
    {
        showServices("10.178.4.15");
    }

    function showServices($vComputerName)
    {
        $objLocator = new COM("WbemScripting.SWbemLocator");

        if ($vComputerName == "") {
            $objService = $objLocator->ConnectServer();
        } else {
            $objService = $objLocator->ConnectServer(
                $vComputerName,
                "root\cimv2",
                'admin_vts',
                'Vts_adm0',
                "MS_409",
                "ntlmdomain:ViTTS"
            );
        }


        foreach ($objService->instancesof('Win32_Process') as $propItem) {

            echo $propItem->Name;

        }
    }
    
    actionIndex();