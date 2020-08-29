<?php
namespace Magenest\Movie\Block\Adminhtml\Movie\Edit;

use Magento\Backend\Block\Widget\Form\Generic;

class Form extends Generic
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    protected $_director;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */

    public function __construct(
        \Magenest\Movie\Model\ResourceModel\MagenestDirector\Collection $director,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        $this->_director = $director;
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('movie_form');
        $this->setTitle(__('Movie Information'));
    }

    public function getUrlAdd()
    {
        return $this->getUrl('movie/director/new');
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('movie_movie');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );

        $form->setHtmlIdPrefix('movie_');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('Movie Information'), 'class' => 'fieldset-wide']
        );

        if ($model->getId()) {
            $fieldset->addField('movie_id', 'hidden', ['name' => 'movie_id']);
        }

        $fieldset->addField(
            'movie_name',
            'text',
            ['name' => 'movie_name', 'label' => __('Movie Name'), 'title' => __('Movie Name'), 'required' => true]
        );

        $fieldset->addField(
            'description',
            'text',
            ['name' => 'description', 'label' => __('Movie Description'), 'title' => __('Movie Description'), 'required' => false]
        );

        $fieldset->addField(
            'rating',
            'text',
            ['name' => 'rating', 'label' => __('Movie Rating'), 'title' => __('Movie Rating'), 'required' => true, 'value' => '0']
        );

        $selectDirector = $this->_director->getDirectoryName();
        $fieldset->addField(
            'director_id',
            'select',
            ['name' => 'director_id',
                'label' => _('Director'),
                'title' => _('Director'),
                'required' => true,
                'values' => $selectDirector,
                'value' => '0', 'disabled' => false, 'readonly' => false
            ]
        );

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
