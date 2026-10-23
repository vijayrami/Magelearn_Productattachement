<?php

declare(strict_types=1);

namespace Magelearn\Productattachement\ViewModel;

use Magento\Catalog\Helper\Data as CatalogData;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Store\Model\StoreManagerInterface;

class Attachment implements ArgumentInterface
{
    public function __construct(
        private readonly CatalogData $catalogData,
        private readonly StoreManagerInterface $storeManager
    ) {
    }

    public function getProduct()
    {
        return $this->catalogData->getProduct();
    }

    public function getAttachment(): ?string
    {
        return $this->getProduct()->getData('attachment');
    }

    public function getAttachmentUrl(string $attachment): string
    {
        return $this->storeManager->getStore()
            ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA)
            . 'catalog/product/attachment/'
            . $attachment;
    }
}