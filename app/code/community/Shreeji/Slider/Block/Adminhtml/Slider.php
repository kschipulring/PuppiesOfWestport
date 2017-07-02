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
class Shreeji_Slider_Block_Adminhtml_Slider extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_slider';
    $this->_blockGroup = 'slider';
    $this->_headerText = Mage::helper('slider')->__('Banner Manager');
    $this->_addButtonLabel = Mage::helper('slider')->__('Add banner image');
    parent::__construct();
  }
}