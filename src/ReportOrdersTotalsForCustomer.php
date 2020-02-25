<?php
declare (strict_types = 1);

namespace Mdoellerer\Subtel;

class ReportOrdersTotalsForCustomer
{
    private $listCustomerOrders = [];

    public function addOrderToReport(string $orderId, float $amount){
        $this->listCustomerOrders[$orderId] = $amount;
    }

    public function getTotalAmount(){
        return array_sum($this->listCustomerOrders);
    }

    public function getNumberOfOrders(){
        return count($this->listCustomerOrders);
    }

}