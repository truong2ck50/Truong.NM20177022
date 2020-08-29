<?php
namespace Magenest\Movie\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class ChangedPingConfig implements ObserverInterface
{
    const TEXT_FIELD_MOVIE = 'movie/moviepage/text_field';

    protected $_scopeConfig;
    protected $_configWriter;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        WriterInterface $configWriter
    ) {
        $this->_scopeConfig = $scopeConfig;
        $this->_configWriter = $configWriter;
    }

    public function getValueText()
    {
        return $this->_scopeConfig->getValue(
            self::TEXT_FIELD_MOVIE,
            \Magento\Framework\App\Config\ScopeConfigInterface::SCOPE_TYPE_DEFAULT
        );
    }

    public function execute(Observer $observer)
    {
        if ($this->getValueText() == 'Ping') {
            $this->_configWriter->save(self::TEXT_FIELD_MOVIE, 'Pong');
        }
    }
}
