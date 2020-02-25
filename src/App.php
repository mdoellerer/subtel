<?php
declare (strict_types = 1);

namespace Mdoellerer\Subtel;

class App
{
    public function __construct(string $customerGUID)
    {              
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


    private function printOutReport(string $customerGUID, ReportOrdersTotalsForCustomer $reportOrders){
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