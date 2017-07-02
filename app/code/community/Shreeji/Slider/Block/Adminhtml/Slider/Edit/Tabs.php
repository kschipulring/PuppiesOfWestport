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

class Shreeji_Slider_Block_Adminhtml_Slider_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('slider_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('slider')->__('Banner Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('slider')->__('Banner Information'),
          'title'     => Mage::helper('slider')->__('Banner Information'),
          'content'   => $this->getLayout()->createBlock('slider/adminhtml_slider_edit_tab_form')->toHtml(),
      ));
	  
	  
     
      return parent::_beforeToHtml();
  }
}