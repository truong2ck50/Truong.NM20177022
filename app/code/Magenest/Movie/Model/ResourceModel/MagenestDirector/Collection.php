<?php
namespace Magenest\Movie\Model\ResourceModel\MagenestDirector;

class Collection extends
    \Magento\Framework\Model\ResourceModel\Db\Collection\
    AbstractCollection {

    protected $_idFieldName = \Magenest\Movie\Model\MagenestDirector::DIRECTOR_ID;

    public function _construct() {
        $this->_init('Magenest\Movie\Model\MagenestDirector',
            'Magenest\Movie\Model\ResourceModel\MagenestDirector');
    }

    public function getDirectoryName()
    {
        $options[] = ['label' => '', 'value' => ''];
        foreach ($this as $key) {
            $options[] = [
                'value' => $key->getData('director_id'),
                'label' => $key->getData('director_name'),
            ];
        }
        return $options;
    }
}
