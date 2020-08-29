<?php

namespace Magenest\Movie\Plugin\Cart;

use Magento\Catalog\Helper\Image;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class ImageItem
{
    protected $_productFactory;

    protected $_imageHelper;

    protected $_product;

    public function __construct(
        Image $imageHelper,
        Product $product,
        CollectionFactory $productFactory
    ) {
        $this->_product = $product;
        $this->_imageHelper = $imageHelper;
        $this->_productFactory = $productFactory;
    }

    public function getProductFactory($productSku)
    {
        $collection = $this->_productFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addFieldToFilter('sku', $productSku);
        return $collection;
    }

    public function aroundGetItemData($subject, $proceed, $item)
    {
        $result = $proceed($item);
        $productSku = $result['product_sku'];

        $productFactory = $this->getProductFactory($productSku);
        foreach ($productFactory as $item) {
            $productName = $item->getName();
            $productId = $item->getId();
        }
        $product = $this->_product->load($productId);
        $imageUrl = $this->_imageHelper->init($product, 'product_page_image_small')->getUrl();

        $result['product_image']['src'] = $imageUrl;
        $result['product_name'] = $productName;
        return $result;
    }
}
