<?php
class Psychose_CallBack_Block_Adminhtml_Callback_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

				$form = new Varien_Data_Form();
				$this->setForm($form);
				$fieldset = $form->addFieldset("callback_form", array("legend"=>Mage::helper("callback")->__("Item information")));

				
						$fieldset->addField("email", "text", array(
						"label" => Mage::helper("callback")->__("email"),
						"name" => "email",
						));
					
						$fieldset->addField("phone", "text", array(
						"label" => Mage::helper("callback")->__("phone"),
						"name" => "phone",
						));
						$fieldset->addField("name", "text", array(
						"label" => Mage::helper("callback")->__("name"),
						"name" => "name",
						));
					$fieldset->addField("message", "textarea", array(
						"label" => Mage::helper("callback")->__("message"),
						"name" => "message",
						'type' => 'textarea'
						));
						$fieldset->addField("status", "select", array(
						"label" => Mage::helper("callback")->__("status"),
						"name" => "status",
	'values' => array(
                                '0' => array(
                                                'value'=> 0,
                                                'label' => Mage::helper("callback")->__("processed")   
                                           ),
                                '1' => array(
                                                'value'=> 1,
                                                'label' => Mage::helper("callback")->__("new") 
                                           ),                                         
                                  
                           ),
						));
						$fieldset->addField('created_time', 'date', array(
  'name'   => 'Date',
  'label'  => Mage::helper("callback")->__("date"),
  'title'  => Mage::helper("callback")->__("date"),
  'image'  => $this->getSkinUrl('images/grid-cal.gif'),
  'input_format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
  'format'       => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
  'time' => false
));
						
					

				if (Mage::getSingleton("adminhtml/session")->getCallbackData())
				{
					$form->setValues(Mage::getSingleton("adminhtml/session")->getCallbackData());
					Mage::getSingleton("adminhtml/session")->setCallbackData(null);
				} 
				elseif(Mage::registry("callback_data")) {
				    $form->setValues(Mage::registry("callback_data")->getData());
				}
				return parent::_prepareForm();
		}
}
