<?php
namespace Magenest\Movie\Block\System\Config\Form\Field;

use Magenest\Movie\Model\MagenestActor;

class ActorCount implements \Magento\Framework\Option\ArrayInterface
{
    protected $_movie;

    public function __construct(MagenestActor $movie)
    {
        $this->_movie = $movie;
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $count = $this->_movie->getCollection()->getSize();
        return [['value' => 1, 'label' => __($count)]];
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
}
