<?php
namespace Magenest\Movie\Model\ResourceModel\MagenestActor;

class Collection extends
    \Magento\Framework\Model\ResourceModel\Db\Collection\
    AbstractCollection {

    protected $_idFieldName = \Magenest\Movie\Model\MagenestActor::ACTOR_ID;

    public function _construct() {
        $this->_init('Magenest\Movie\Model\MagenestActor',
            'Magenest\Movie\Model\ResourceModel\MagenestActor');
    }

    public function getJoinData()
    {
        $this->getSelect()->join(
            'magenest_movie_actor',
            'main_table.actor_id = magenest_movie_actor.actor_id'
        );
        return $this;
    }
}
