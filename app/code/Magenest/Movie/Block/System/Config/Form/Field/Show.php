<?php
namespace Magenest\Movie\Block\System\Config\Form\Field;

class Show implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [['value' => 1, 'label' => __('Show')], ['value' => 2, 'label' => __('Not show')]];
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return [1 => __('Show'), 2 => __('Not show')];
    }
}
