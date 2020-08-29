<?php
namespace Magenest\Movie\Model\ResourceModel\MagenestMovie;

class Collection extends
    \Magento\Framework\Model\ResourceModel\Db\Collection\
    AbstractCollection {

    protected $_idFieldName = \Magenest\Movie\Model\MagenestMovie::MOVIE_ID;

    public function _construct() {
        $this->_init('Magenest\Movie\Model\MagenestMovie',
            'Magenest\Movie\Model\ResourceModel\MagenestMovie');
    }

    public function getJoin()
    {
        $this->getSelect()->join(
            'magenest_director',
            'main_table.director_id = magenest_director.director_id'
        );
        return $this;
    }
}
