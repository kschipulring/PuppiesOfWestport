<?php

class Psychose_CallBack_Adminhtml_CallbackkController extends Mage_Adminhtml_Controller_Action
{
		protected function _initAction()
		{

			echo "this is a test for this damn plugin";


			//$this->_response->_body = array( "this may work" );

			$this->_response->setBody( "some test content" );

			$this->loadLayout()->_setActiveMenu("callback/callback")->_addBreadcrumb(Mage::helper("adminhtml")->__("Callback  Manager"),Mage::helper("adminhtml")->__("Callback Manager"));

			var_dump( $this->_response );

			return $this;
		}
		public function indexAction() 
		{
			$this->_title($this->__("CallBack"));
			$this->_title($this->__("Manager Callback"));

			$this->_initAction();
			$this->renderLayout();
		}
		public function editAction()
		{			    
			    $this->_title($this->__("CallBack"));
				$this->_title($this->__("Callback"));
			    $this->_title($this->__("Edit Item"));
				
				$id = $this->getRequest()->getParam("id");
				$model = Mage::getModel("callback/callback")->load($id);
				if ($model->getId()) {
					Mage::register("callback_data", $model);
					$this->loadLayout();
					$this->_setActiveMenu("callback/callback");
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Callback Manager"), Mage::helper("adminhtml")->__("Callback Manager"));
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Callback Description"), Mage::helper("adminhtml")->__("Callback Description"));
					$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
					$this->_addContent($this->getLayout()->createBlock("callback/adminhtml_callback_edit"))->_addLeft($this->getLayout()->createBlock("callback/adminhtml_callback_edit_tabs"));
					$this->renderLayout();
				} 
				else {
					Mage::getSingleton("adminhtml/session")->addError(Mage::helper("callback")->__("Item does not exist."));
					$this->_redirect("*/*/");
				}
		}

		public function newAction()
		{

		$this->_title($this->__("CallBack"));
		$this->_title($this->__("Callback"));
		$this->_title($this->__("New Item"));

        $id   = $this->getRequest()->getParam("id");
		$model  = Mage::getModel("callback/callback")->load($id);

		$data = Mage::getSingleton("adminhtml/session")->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		Mage::register("callback_data", $model);

		$this->loadLayout();
		$this->_setActiveMenu("callback/callback");

		$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Callback Manager"), Mage::helper("adminhtml")->__("Callback Manager"));
		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Callback Description"), Mage::helper("adminhtml")->__("Callback Description"));


		$this->_addContent($this->getLayout()->createBlock("callback/adminhtml_callback_edit"))->_addLeft($this->getLayout()->createBlock("callback/adminhtml_callback_edit_tabs"));

		$this->renderLayout();

		}
		public function saveAction()
		{

			$post_data=$this->getRequest()->getPost();


				if ($post_data) {

					try {

						$model = Mage::getModel("callback/callback")
						->addData($post_data)
						->setId($this->getRequest()->getParam("id"))
						->save();

						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Callback was successfully saved"));
						Mage::getSingleton("adminhtml/session")->setCallbackData(false);

						if ($this->getRequest()->getParam("back")) {
							$this->_redirect("*/*/edit", array("id" => $model->getId()));
							return;
						}
						$this->_redirect("*/*/");
						return;
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						Mage::getSingleton("adminhtml/session")->setCallbackData($this->getRequest()->getPost());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					return;
					}

				}
				$this->_redirect("*/*/");
		}



		public function deleteAction()
		{
				if( $this->getRequest()->getParam("id") > 0 ) {
					try {
						$model = Mage::getModel("callback/callback");
						$model->setId($this->getRequest()->getParam("id"))->delete();
						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item was successfully deleted"));
						$this->_redirect("*/*/");
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					}
				}
				$this->_redirect("*/*/");
		}

		
		public function massRemoveAction()
		{
			try {
				$ids = $this->getRequest()->getPost('ids', array());
				foreach ($ids as $id) {
                      $model = Mage::getModel("callback/callback");
					  $model->setId($id)->delete();
				}
				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item(s) was successfully removed"));
			}
			catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
			}
			$this->_redirect('*/*/');
		}
			
		/**
		 * Export order grid to CSV format
		 */
		public function exportCsvAction()
		{
			$fileName   = 'callback.csv';
			$grid       = $this->getLayout()->createBlock('callback/adminhtml_callback_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
		} 
		/**
		 *  Export order grid to Excel XML format
		 */
		public function exportExcelAction()
		{
			$fileName   = 'callback.xml';
			$grid       = $this->getLayout()->createBlock('callback/adminhtml_callback_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
		}
}
