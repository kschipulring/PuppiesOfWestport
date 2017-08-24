<?php


class Psychose_CallBack_Block_Adminhtml_Callback extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct()
	{

	$this->_controller = "adminhtml_callback";
	$this->_blockGroup = "callback";
	//$this->_headerText = Mage::helper("callback")->__("Callback Manager");

	$this->_headerText = "you redonkulous ape";

	$this->_addButtonLabel = Mage::helper("callback")->__("Add New Item");
	parent::__construct();
	
	}

}