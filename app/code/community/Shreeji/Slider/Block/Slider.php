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
class Shreeji_Slider_Block_Slider extends Mage_Core_Block_Template {

	public function getImageCollection() {
		$collection = Mage::getModel('slider/slider')->getCollection()->addFieldToFilter('status',1)->setOrder('sort_order', 'ASC');		
		$banners = array();
		foreach ($collection as $banner) {			
				$banners[] = $banner;
		}
		return $banners;
	}
	
} 