<?php
/**
 * Catalog category model
 *
 * @category    Mage
 * @package     ThreeRingDesign_HideEmptyOutOfStockCategories
 * @author      Karl Schipul <karl@3ringprototype.com>
 */
class ThreeRingDesign_HideEmptyOutOfStockCategories_Model_Resource_Category extends Mage_Catalog_Model_Resource_Category
{
	public function getProductCount($category)
	{
		$productTable = Mage::getSingleton('core/resource')->getTableName('catalog/category_product');

		$productQuantityTable = Mage::getSingleton('core/resource')->getTableName( 'cataloginventory/stock_item' );

		$select = $this->getReadConnection()->select()
		->from(
			array('main_table' => $productTable),
			array(new Zend_Db_Expr('COUNT(main_table.product_id)'))
		)
		->where('main_table.category_id = :category_id and quan.qty > 0')
		->joinLeft(
			array('quan' => $productQuantityTable), 
			'quan.product_id = main_table.product_id',
			array('qty')
		);

		$bind = array('category_id' => (int)$category->getId());
		$counts = $this->getReadConnection()->fetchOne($select, $bind);

		return intval($counts);
	}
}