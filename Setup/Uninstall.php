<?php
namespace Magelearn\Productattachement\Setup;

use Magento\Framework\Setup\UninstallInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class Uninstall implements UninstallInterface
{
	/**
     	* @var EavSetupFactory
    	 */
    	protected $_eavSetupFactory;

    	public function __construct(
		EavSetupFactory $eavSetupFactory
    	) {
		$this->_eavSetupFactory = $eavSetupFactory;
    	}
	
	public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
	{
		$this->moduleDataSetup->getConnection()->startSetup();
		/** @var EavSetup $eavSetup */
		$eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
		$eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'attachment');

		$this->moduleDataSetup->getConnection()->endSetup();
	}
}
