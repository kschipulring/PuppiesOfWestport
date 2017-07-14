<?php

class Naya_CallForPrice_Model_Observer {

    public function catalog_product_is_salable_after($observer) {
        $product = $observer->getEvent()->getProduct();
        $salable = $observer->getEvent()->getSalable();
        
        if($this->_getEnableCallforPrice($product) == 1){
            $salable->setIsSalable(0);
            //remove "not available" message with js, using this tag:
            echo '<span class="remove-unavailable-tag"></span>';
        }
    }
    
    public function coreBlockAbstractToHtmlBefore($observer) {
        //set custom price template
        $block = $observer->getBlock();
        $product = $block->getProduct();
        
        if ($product) {
            
            if($this->_getEnableCallforPrice($product) == 1 && (get_class($block) == 'Mage_Catalog_Block_Product_Price' || get_class($block) == 'Mage_Bundle_Block_Catalog_Product_Price')){
                if($block->getTemplate() == 'catalog/product/price.phtml' || $block->getTemplate() == 'bundle/catalog/product/price.phtml'){
                    $block->setTemplate('naya/callforprice/price.phtml');
                }else{
                    $block->setTemplate('naya/callforprice/nodisplay.phtml');
                }
            }
        }
    }
    
    public function customizeCollection($observer){
        $hideProductsFromPricefilter = false;
        
        $appliedFilters = Mage::getSingleton('catalog/layer')->getState()->getFilters();
        foreach ($appliedFilters as $item) {
            if($item->getFilter()->getRequestVar() == 'price'){
                $hideProductsFromPricefilter = true;
                break;
            }
        }
        
        if($hideProductsFromPricefilter){
            $observer->getEvent()->getCollection()
                ->addAttributeToFilter(
                        array(
                            array('attribute'=>'naya_call_for_price_enable', array('eq' => 0)),
                            array('attribute'=>'naya_call_for_price_enable', array('null' => 1))
                        ), '', 'left');
        }
    }

    
    private function _getEnableCallforPrice($product){
        $eavAttribute = new Mage_Eav_Model_Mysql4_Entity_Attribute();
        $code = $eavAttribute->getIdByCode('catalog_product', 'naya_call_for_price_enable');

        $preConnection = Mage::getSingleton('core/resource');

        $connection = $preConnection->getConnection('core_read');

        $cpei = $preConnection->getTableName('catalog_product_entity_int');

        $sql = <<<SQL
            SELECT `value`
            FROM {$cpei}
            WHERE entity_id = {$product->getId()}
            AND attribute_id = {$code}
SQL;

        $row = $connection->fetchRow($sql);
        return $row['value'];
    }
}
?>
