<?php
namespace Magenest\Movie\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class ChangedRatingMovie implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        $rating = 0;
        $movie = $observer->getData('movie');
        $movie->setData('rating', $rating);
    }
}