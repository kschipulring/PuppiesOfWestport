<?php
class Psychose_CallBack_Block_Adminhtml_Callback_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
		public function __construct()
		{
				parent::__construct();
				$this->setId("callback_tabs");
				$this->setDestElementId("edit_form");
				$this->setTitle(Mage::helper("callback")->__("Item Information"));
		}
		protected function _beforeToHtml()
		{
				$this->addTab("form_section", array(
				"label" => Mage::helper("callback")->__("Item Information"),
				"title" => Mage::helper("callback")->__("Item Information"),
				"content" => $this->getLayout()->createBlock("callback/adminhtml_callback_edit_tab_form")->toHtml(),
				));
				return parent::_beforeToHtml();
		}

}
