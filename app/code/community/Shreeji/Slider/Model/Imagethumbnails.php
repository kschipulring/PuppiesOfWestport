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
class Shreeji_Slider_Model_Imagethumbnails{
    protected $_options;
	const IMAGETHUMB_THUMBNAIL = 'thumbnail';
    const IMAGETHUMB_PAGINATION  = 'pagination';
    const IMAGETHUMB_NONE	= 'none';    
    
    public function toOptionArray(){
        if (!$this->_options) {
			$this->_options[] = array(
			   'value'=>self::IMAGETHUMB_THUMBNAIL,
			   'label'=>Mage::helper('slider')->__('Thumbnails')
			);
			$this->_options[] = array(
			   'value'=>self::IMAGETHUMB_PAGINATION,
			   'label'=>Mage::helper('slider')->__('Pagination')
			);
			$this->_options[] = array(
			   'value'=>self::IMAGETHUMB_NONE,
			   'label'=>Mage::helper('slider')->__('None')
			);			

		}
		return $this->_options;
	}
}
