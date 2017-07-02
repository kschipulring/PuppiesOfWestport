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

class Shreeji_Slider_Block_Adminhtml_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $row)
    {		
		$model  = Mage::getModel('slider/slider')->load($row->getId());
		$file = $model->getFilename();		
				
		$url = Mage::getBaseUrl('media') . 'mbimages/thumbs/' . $file;
		$out = "<img src=". $url ." width='80px'/>";
		return $out;
	}
}