<?php

class Naya_CallForPrice_Block_Checkout_Cart_Crosssell extends Mage_Checkout_Block_Cart_Crosssell
{
    public function getAddToCartUrl($product, $additional = array())
    {
        if($this->_getEnableCallforPrice($product) == 1){
            //remove add to cart button on crosssell page with js, using this tag:
            return 'remove-add-to-cart';
        }
        return parent::getAddToCartUrl($product, $additional = array());
    }
    
    private function _getEnableCallforPrice($product){
        $eavAttribute = new Mage_Eav_Model_Mysql4_Entity_Attribute();
        $code = $eavAttribute->getIdByCode('catalog_product', 'naya_call_for_price_enable');
        $connection = Mage::getSingleton('core/resource')->getConnection('core_read');
        $sql = <<<SQL
            SELECT `value`
            FROM catalog_product_entity_int
            WHERE entity_id = {$product->getId()}
            AND attribute_id = {$code}
SQL;
        $row = $connection->fetchRow($sql);
        return $row['value'];
    }
}
