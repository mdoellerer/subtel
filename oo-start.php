<?php
    namespace Mdoellerer\Subtel;

    require 'vendor/autoload.php';

    $jsonFilesPath = dirname(__FILE__)  . '//json-files//';
    $customerGUID = 'c5f987b9-52da-4358-a425-760262482fc0';
    
    $time_start = microtime(true); 
    $fileServices = new FileServices();

    $files = $fileServices->getFilesCollection($jsonFilesPath);

    $fileReader = FileReaderFactory::createReader('json');
    $reportOrders = new ReportOrdersTotalsForCustomer();

    foreach ($files as $filePath){
        $fileContent = $fileReader->readFile($filePath);

        foreach ($fileContent as $order){
            $orderObject = new ExternalChannelsOrders($order);
            if ($orderObject->isOrderFromCustomerAndConfirmed($customerGUID)){
                $reportOrders->addOrderToReport($orderObject->getOrderId(), $orderObject->getAmount());              
            }         
        }        
    }

    echo "Customer {$customerGUID} total amount of " . $reportOrders->getTotalAmount() . ' in ' . $reportOrders->getNumberOfOrders() . ' orders. ' . PHP_EOL;

    $time_end = microtime(true);  
    $execution_time = ($time_end - $time_start)/60;
    echo 'Total Execution Time: '.$execution_time.' secs' . PHP_EOL;  
    echo 'Usage: ' . round(memory_get_usage() / 1024) . 'KB of memory' . PHP_EOL;
    