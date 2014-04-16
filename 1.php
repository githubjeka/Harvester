<?php
 function actionIndex()
    {
        showServices("ipcomp");
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
                'username',
                'password',
                "MS_409",
                "ntlmdomain:ViTTS"
            );
        }


        foreach ($objService->instancesof('Win32_Process') as $propItem) {

            echo $propItem->Name;

        }
    }
    
    actionIndex();