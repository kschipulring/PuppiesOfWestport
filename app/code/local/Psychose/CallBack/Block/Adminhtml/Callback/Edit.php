<?php
	
class Psychose_CallBack_Block_Adminhtml_Callback_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
		public function __construct()
		{

				parent::__construct();
				$this->_objectId = "id";
				$this->_blockGroup = "callback";
				$this->_controller = "adminhtml_callback";
				$this->_updateButton("save", "label", Mage::helper("callback")->__("Save Item"));
				$this->_updateButton("delete", "label", Mage::helper("callback")->__("Delete Item"));

				$this->_addButton("saveandcontinue", array(
					"label"     => Mage::helper("callback")->__("Save And Continue Edit"),
					"onclick"   => "saveAndContinueEdit()",
					"class"     => "save",
				), -100);



				$this->_formScripts[] = "

							function saveAndContinueEdit(){
								editForm.submit($('edit_form').action+'back/edit/');
							}
						";
		}

		public function getHeaderText()
		{
				if( Mage::registry("callback_data") && Mage::registry("callback_data")->getId() ){

				    return Mage::helper("callback")->__("Edit Item '%s'", $this->htmlEscape(Mage::registry("callback_data")->getId()));

				} 
				else{

				     return Mage::helper("callback")->__("Add Item");

				}
		}
}