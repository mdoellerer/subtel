<?php
    $filesPath = dirname(__FILE__)  . '//json-files//';

    /**
     * stdClass::__set_state(array(
     * 'order_id' => 'f35941e0f877b50bd60499bae60a3d0e',
     * 'payment_status' => 'pending',
     * 'amount' => 1450.05,
     * 'received_at' => '2019-09-09T06:47:12Z',
     * 'customer_id' => 'c5f987b9-52da-4358-a425-760262482fc0',
     * 'first_name' => 'Erich',
     * 'last_name' => 'Carette',
     * ))
     */


    $customer['id'] = 'c5f987b9-52da-4358-a425-760262482fc0';
    $customer['total_orders'] = 0;
    $customer['total_amount'] = 0;

    //START ALL HERE
    $files = outputFilesGlob($filesPath);
    
    foreach ($files as $singleFilePath){
        $decodedContent = readJsonFile($singleFilePath);
        $customer = getOrdersByCustomerGUID($customer, $decodedContent);
    }
    getOrderTotalsByCustomer($customer);
        


    function outputFilesGlob (string $filePath){
        foreach(glob("json-files/*.json") as $file){            
            $array_files[] = $file;
        }
        return $array_files;
    }

    function readJsonFile (string $file){
        echo basename($file) . " (size: " . filesize($file) . " bytes)" . PHP_EOL;
        $content = file_get_contents($file);

        return json_decode($content);     
    }

    function getOrdersByCustomerGUID (array $customer, array $decoded_content){
        foreach ($decoded_content as $stdclass){  
            if ($stdclass->customer_id === $customer['id']) {
                echo $stdclass->amount . ' - ' . $stdclass->payment_status . PHP_EOL;
                if ($stdclass->payment_status === 'confirmed'){
                    $customer['total_orders']++;
                    $customer['total_amount'] += $stdclass->amount;                   
                }
            }      
        }
        return ($customer);
    }

    function getOrderTotalsByCustomer($customer){
        var_export($customer);
        echo PHP_EOL; 
    }

?>