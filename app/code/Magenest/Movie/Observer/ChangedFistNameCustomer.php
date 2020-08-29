<?php
namespace Magenest\Movie\Observer;

use Magento\Customer\Model\Customer;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class ChangedFistNameCustomer implements ObserverInterface
{
    protected $_customer;

    public function __construct(
        Customer $customer
    ) {
        $this->_customer = $customer;
    }

    public function execute(Observer $observer)
    {
        /** @var \Magento\Customer\Model\Customer $customer */
        $firstName = 'Magenest';
        $customer = $observer->getData('customer');
        $customer->setData('firstname', $firstName);
    }
}
