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
class Shreeji_Slider_Model_Loader{
    protected $_options;
	const BANNERLOADER_PIE = 'pie';
	const BANNERLOADER_BAR = 'bar';
	const BANNERLOADER_NONE = 'none';     
    
    public function toOptionArray(){
        if (!$this->_options) {
			$this->_options[] = array(
			   'value'=>self::BANNERLOADER_PIE,
			   'label'=>Mage::helper('slider')->__('Pie')
			);
			$this->_options[] = array(
			   'value'=>self::BANNERLOADER_BAR,
			   'label'=>Mage::helper('slider')->__('Bar')
			);
			$this->_options[] = array(
			   'value'=>self::BANNERLOADER_NONE,
			   'label'=>Mage::helper('slider')->__('None')
			);
		}
		return $this->_options;
	}
}