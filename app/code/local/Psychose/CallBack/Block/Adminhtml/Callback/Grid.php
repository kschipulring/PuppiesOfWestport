<?php

class Psychose_CallBack_Block_Adminhtml_Callback_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("callbackGrid");
				$this->setDefaultSort("id");
				$this->setDefaultDir("DESC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("callback/callback")->getCollection();
				$this->setCollection($collection);
				return parent::_prepareCollection();
		}
		protected function _prepareColumns()
		{
				$this->addColumn("id", array(
				"header" => Mage::helper("callback")->__("ID"),
				"align" =>"right",
				"width" => "50px",
			    "type" => "number",
				"index" => "id",
				));
                
				$this->addColumn("email", array(
				"header" => Mage::helper("callback")->__("email"),
				"index" => "email",
				));
				$this->addColumn("phone", array(
				"header" => Mage::helper("callback")->__("phone"),
				"index" => "phone",
				));
				$this->addColumn("status", array(
				"header" => Mage::helper("callback")->__("status"),
				"index" => "status",
				'type' => 'options',
        'options'=> array (Mage::helper("callback")->__("processed"),Mage::helper("callback")->__("new"))
				));
					$this->addColumn('created_time', array(
						'header'    => Mage::helper('callback')->__('date'),
						'index'     => 'created_time',
						'type'      => 'date',
					));
			$this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV')); 
			$this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel'));

				return parent::_prepareColumns();
		}

		public function getRowUrl($row)
		{
			   return $this->getUrl("*/*/edit", array("id" => $row->getId()));
		}


		
		protected function _prepareMassaction()
		{
			$this->setMassactionIdField('id');
			$this->getMassactionBlock()->setFormFieldName('ids');
			$this->getMassactionBlock()->setUseSelectAll(true);
			$this->getMassactionBlock()->addItem('remove_callback', array(
					 'label'=> Mage::helper('callback')->__('Remove Callback'),
					 'url'  => $this->getUrl('*/adminhtml_callback/massRemove'),
					 'confirm' => Mage::helper('callback')->__('Are you sure?')
				));
			return $this;
		}
			

}