<?php
namespace Magenest\Movie\Model;

class MagenestDirector extends \Magento\Framework\Model\AbstractModel {

    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_DECLINED = 'declined';
    const DIRECTOR_ID = 'director_id';

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource
        $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb
        $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource,
            $resourceCollection, $data);
    }

    public function _construct() {
        $this->_init
        ('Magenest\Movie\Model\ResourceModel\MagenestDirector');
    }
}
