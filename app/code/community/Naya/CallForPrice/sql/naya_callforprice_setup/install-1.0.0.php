<?php

$this->startSetup();

$modelGroup = Mage::getModel('eav/entity_attribute_group');
$modelGroup->setAttributeGroupName('Call for price')
        ->setAttributeSetId(Mage::getModel('catalog/product')->getDefaultAttributeSetId())
        ->setSortOrder(100);
$modelGroup->save();

$setup = new Mage_Catalog_Model_Resource_Eav_Mysql4_Setup('core_setup');
$setup->addAttribute('catalog_product', 'naya_call_for_price_enable', array(
	'group'           => 'Call for price',
	'input'           => 'boolean',
        'type'            => 'int',
	'label'           => 'Enable "Call for price" for this product',
	'global'          => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
	'required'        => 0,
        //'user_defined'    => 1,
));

$setup->addAttribute('catalog_product', 'naya_call_for_price_text', array(
	'group'           => 'Call for price',
        'input'           => 'text',
        'type'            => 'varchar',
	'label'           => 'Replace price message',
	'global'          => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
	'required'        => 0,
        //'user_defined'    => 1,
));


$this->endSetup();
