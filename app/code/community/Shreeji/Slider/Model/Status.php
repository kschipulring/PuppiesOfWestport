<?php
/**
 *
 * Version			: 1.0.4
 * Edition 			: Community 
 * Compatible with 	: Magento 1.5.x to latest
 * Developed By 	: ShreejiSlider
 * Email			: info@shreeji-infosys.com
 * Web URL 			: www.shreeji-infosoft.com
 * Extension		: ShreejiSlider Easy Banner slider
 * 
 */
?>
<?php

class Shreeji_Slider_Model_Status extends Varien_Object
{
    const STATUS_ENABLED	= 1;
    const STATUS_DISABLED	= 2;

    static public function getOptionArray()
    {
        return array(
            self::STATUS_ENABLED    => Mage::helper('slider')->__('Enabled'),
            self::STATUS_DISABLED   => Mage::helper('slider')->__('Disabled')
        );
    }
}