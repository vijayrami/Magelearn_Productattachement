<?php
namespace Magelearn\Productattachement\Ui\DataProvider\Product\Form\Modifier;
 
use Magento\Framework\Stdlib\ArrayManager;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
 
class File extends AbstractModifier
{
    /**
     * @var ArrayManager
     */
    protected $arrayManager;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;
 
    /**
     * @param ArrayManager $arrayManager
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ArrayManager $arrayManager,
        StoreManagerInterface $storeManager
    ) {
        $this->arrayManager = $arrayManager;
        $this->storeManager = $storeManager;
    }
 
    public function modifyMeta(array $meta)
    {
        $fieldCode = 'attachment';
        $elementPath = $this->arrayManager->findPath($fieldCode, $meta, null, 'children');
        $containerPath = $this->arrayManager->findPath(static::CONTAINER_PREFIX . $fieldCode, $meta, null, 'children');
 
        if (!$elementPath) {
            return $meta;
        }
		
 		$mediaUrl =  $this->storeManager->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
		
		$attachementUrl =  $mediaUrl . 'catalog/product/attachment/';
			
        $meta = $this->arrayManager->merge(
            $containerPath,
            $meta,
            [
                'children'  => [
                    $fieldCode => [
                        'arguments' => [
                            'data' => [
                                'config' => [
                                    'elementTmpl'   => 'Magelearn_Productattachement/elements/file',
                                    'attachment_url' => $attachementUrl
                                ],
                            ],
                        ],
                    ]
                ]
            ]
        );
        return $meta;
    }
 
    /**
     * {@inheritdoc}
     */
    public function modifyData(array $data)
    {
        return $data;
    }
}