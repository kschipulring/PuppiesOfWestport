<?php

class ThreeRingDesign_SkuSorter_Catalog_Block_Product_Widget_New extends Mage_Catalog_Block_Product_Widget_New{
	protected function _getProductCollection(){
		switch ($this->getDisplayType()) {
			case self::DISPLAY_TYPE_NEW_PRODUCTS:
				$collection = parent::_getProductCollection();
				$collection->addAttributeToSort('sku', 'ASC');
				//or $collection->addAttributeToSort('name', 'desc'); 
				break;
			default:
				$collection = $this->_getRecentlyAddedProductsCollection();
				break;
		}
		return $collection;
	}
}

?>