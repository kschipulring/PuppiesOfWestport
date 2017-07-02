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

class Shreeji_Slider_Block_Adminhtml_Slider_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('slider_form', array('legend'=>Mage::helper('slider')->__('Banner information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('slider')->__('Image Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
      ));	

      $fieldset->addField('filename', 'image', array(
          'label'     => Mage::helper('slider')->__('Image'),
          'required'  => false,
          'name'      => 'filename',
	  ));	
	  
	  
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('slider')->__('Image Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('slider')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('slider')->__('Disabled'),
              ),
          ),
      ));
			
	  $fieldset->addField('weblink', 'text', array(
          'label'     => Mage::helper('slider')->__('Image Url'),
		  'class'     => 'validate-url',
          'required'  => false,
		  'after_element_html' => "<small>Image URL</small>",
          'name'      => 'weblink',
      ));
	  
	  $fieldset->addField('linktarget', 'select', array(
				  'label'     => Mage::helper('slider')->__('Link Target'),
				  'name'      => 'linktarget',
				  'after_element_html' => "<small>New Tab: To open in new tab, Same Tab: To open in same tab</small>",
				  'values'    => array(
					  array(
						  'value'     => '_self',
						  'label'     => Mage::helper('slider')->__('Same Tab'),
					  ),
				  
					  array(
						  'value'     => '_blank',
						  'label'     => Mage::helper('slider')->__('New Tab'),
					  )
				  ),
			));
			
		$fieldset->addField('sort_order', 'text', array(
			'name'		=> 'sort_order',
			'label'		=> $this->__('Sort Order'),
			'title'		=> $this->__('Sort Order'),
			'class'		=> 'validate-digits'
		));
			
      $fieldset->addField('content', 'editor', array(
          'name'      => 'content',
          'label'     => Mage::helper('slider')->__('Content'),
          'title'     => Mage::helper('slider')->__('Content'),
          'style'     => 'width:280px; height:100px;',
          'wysiwyg'   => false,
          'required'  => false,
      ));
			
     
      if ( Mage::getSingleton('adminhtml/session')->getImageSliderData() )
      {
          $data = Mage::getSingleton('adminhtml/session')->getImageSliderData();
          Mage::getSingleton('adminhtml/session')->setImageSliderData(null);
      } elseif ( Mage::registry('slider_data') ) {
          $data = Mage::registry('slider_data')->getData();
      }
	  if (isset($data['stores'])) {
		$data['store_id'] = explode(',',$data['stores']);
	  }
	  $form->setValues($data);
	  
      return parent::_prepareForm();
  }
}