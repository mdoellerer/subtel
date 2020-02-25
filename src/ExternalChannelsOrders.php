<?php
declare (strict_types = 1);

namespace Mdoellerer\Subtel;

class ExternalChannelsOrders
{
    private const PAYMENT_CONFIRMED = 'confirmed';

    public function __construct($object) { 
        foreach ($object as $property => $value){
            $this->$property = $value;
        }
    }  

    public function getCustomerId(){
        return $this->customer_id;
    }

    public function isPaymentConfirmed(){
        return $this->payment_status === self::PAYMENT_CONFIRMED;
    }

    public function isOrderFromCustomerAndConfirmed(string $customerGUID){
        if ($this->isPaymentConfirmed() === false){
            return false;
        }
        if ($this->getCustomerId() !== $customerGUID){
            return false;
        }
        return true;
    }

    public function getOrderId(){
        return $this->order_id;
    }

    public function getAmount(){
        return $this->amount;
    }
}