<?php
declare (strict_types = 1);

namespace Mdoellerer\Subtel;

class App
{
    public function __construct(string $customerGUID = null)
    {       
        //The following IF is just because we are in a DEMO software, this was the example
        // used for check all cases, I only left this here so it is quicker to test and to show.
        if (is_null($customerGUID)){
            $customerGUID = 'c5f987b9-52da-4358-a425-760262482fc0';
        }
        
        $jsonFilesPath = dirname(__FILE__)  . '//json-files//';
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
        
        $this->printOutReport($customerGUID, $reportOrders);      
        $this->printOutExecutionTime($time_start);
    }


    private function printOutReport(string $customerGUID, ReportOrdersTotalsForCustomers $reportOrders){
        $result = "Customer {$customerGUID} total amount of " 
            . $reportOrders->getTotalAmount() . ' in ' 
            . $reportOrders->getNumberOfOrders() . ' orders. ' . PHP_EOL;

        echo $result;    
    }

    
    private function printOutExecutionTime($initialMicrotime){
        $time_end = microtime(true);  
        $execution_time = ($time_end - $initialMicrotime)/60;
        echo 'Total Execution Time: '.$execution_time.' secs' . PHP_EOL;  
    }

    
}