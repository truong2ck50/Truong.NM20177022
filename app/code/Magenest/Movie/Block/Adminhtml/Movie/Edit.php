<?php
namespace Magenest\Movie\Block\Adminhtml\Movie;

use Magento\Backend\Block\Widget\Context;
use Magento\Backend\Block\Widget\Form\Container;
use Magento\Framework\Registry;

class Edit extends Container
{
    /**
     * @var Registry|null
     */
    protected $_coreRegistry = null;

    /**
     * Edit constructor.
     * @param Context $context
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     *
     */
    protected function _construct()
    {
        $this->_objectId = 'movie_id';
        $this->_blockGroup = 'Magenest_Movie';
        $this->_controller = 'adminhtml_movie';

        parent::_construct();

        if ($this->_isAllowedAction('Magenest_Movie::movie_save')) {
            $this->buttonList->update('save', 'label', __('Save Movie'));
            $this->buttonList->add(
                'saveandcontinue',
                [
                    'label' => __('Save and Continue Edit'),
                    'class' => 'save',
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                        ],
                    ]
                ],
                -100
            );
        } else {
            $this->buttonList->remove('save');
        }
    }

    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('movie_movie')->getId()) {
            return __("Edit Movie '%1'", $this->escapeHtml($this->_coreRegistry->registry('movie_movie')->getQuestion()));
        } else {
            return __('New Movie');
        }
    }

    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl('movie/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '']);
    }
}
