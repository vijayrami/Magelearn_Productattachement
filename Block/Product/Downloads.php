<?php 
namespace Magelearn\Productattachement\Block\Product;

use Magento\Framework\View\Element\Template;

/**
 * Class:Downloads
 * Magelearn\Productattachement\Block
 *
 * @author      Sebwite
 * @package     Magelearn\Productattachement
 * @copyright   Copyright (c) 2015, Sebwite. All rights reserved
 */
class Downloads extends Template
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Registry                      $coreRegistry
     */
    public function __construct(
            \Magento\Framework\View\Element\Template\Context $context,
            \Magento\Framework\Registry $coreRegistry,
            \Magento\Store\Model\StoreManagerInterface $storeManager
    )
    {
        $this->coreRegistry = $coreRegistry;
        $this->_storeManager = $storeManager;
        parent::__construct($context);
    }

    /**
     * Return Downloads
     *
     * @return mixed
     */
    public function getProductAttachment()
    {
        return $this->getProduct()->getAttachment();
    }

    /**
     * Return current product instance
     *
     * @return \Magento\Catalog\Model\Product
     */
    public function getProduct()
    {
        return $this->coreRegistry->registry('product');
    }

    /**
     *
     * @return string
     */
    public function getAttachmentUrl()
    {
        // @TODO - index.php weghalen
        $mediaUrl = $this ->_storeManager-> getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA );
        return $mediaUrl . 'catalog/product/attachment/' . $this->getProduct()->getAttachment();
    }
}