<?php

class Istreet_Locator_Adminhtml_StoresController extends Mage_Adminhtml_Controller_Action
{
		protected function _isAllowed()
		{
		//return Mage::getSingleton('admin/session')->isAllowed('locator/stores');
			return true;
		}

		protected function _initAction()
		{
				$this->loadLayout()->_setActiveMenu("locator/stores")->_addBreadcrumb(Mage::helper("adminhtml")->__("Stores  Manager"),Mage::helper("adminhtml")->__("Stores Manager"));
				return $this;
		}
		public function indexAction() 
		{
			    $this->_title($this->__("Locator"));
			    $this->_title($this->__("Manager Stores"));

				$this->_initAction();
				$this->renderLayout();
		}
		public function editAction()
		{			    
			    $this->_title($this->__("Locator"));
				$this->_title($this->__("Stores"));
			    $this->_title($this->__("Edit Item"));
				
				$id = $this->getRequest()->getParam("id");
				$model = Mage::getModel("locator/stores")->load($id);
				if ($model->getId()) {
					Mage::register("stores_data", $model);
					$this->loadLayout();
					$this->_setActiveMenu("locator/stores");
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Stores Manager"), Mage::helper("adminhtml")->__("Stores Manager"));
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Stores Description"), Mage::helper("adminhtml")->__("Stores Description"));
					$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
					$this->_addContent($this->getLayout()->createBlock("locator/adminhtml_stores_edit"))->_addLeft($this->getLayout()->createBlock("locator/adminhtml_stores_edit_tabs"));
					$this->renderLayout();
				} 
				else {
					Mage::getSingleton("adminhtml/session")->addError(Mage::helper("locator")->__("Item does not exist."));
					$this->_redirect("*/*/");
				}
		}

		public function newAction()
		{

		$this->_title($this->__("Locator"));
		$this->_title($this->__("Stores"));
		$this->_title($this->__("New Item"));

        $id   = $this->getRequest()->getParam("id");
		$model  = Mage::getModel("locator/stores")->load($id);

		$data = Mage::getSingleton("adminhtml/session")->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		Mage::register("stores_data", $model);

		$this->loadLayout();
		$this->_setActiveMenu("locator/stores");

		$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Stores Manager"), Mage::helper("adminhtml")->__("Stores Manager"));
		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Stores Description"), Mage::helper("adminhtml")->__("Stores Description"));


		$this->_addContent($this->getLayout()->createBlock("locator/adminhtml_stores_edit"))->_addLeft($this->getLayout()->createBlock("locator/adminhtml_stores_edit_tabs"));

		$this->renderLayout();

		}
		public function saveAction()
		{

			$post_data=$this->getRequest()->getPost();


				if ($post_data) {

					try {

						

						$model = Mage::getModel("locator/stores")
						->addData($post_data)
						->setId($this->getRequest()->getParam("id"))
						->save();

						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Stores was successfully saved"));
						Mage::getSingleton("adminhtml/session")->setStoresData(false);

						if ($this->getRequest()->getParam("back")) {
							$this->_redirect("*/*/edit", array("id" => $model->getId()));
							return;
						}
						$this->_redirect("*/*/");
						return;
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						Mage::getSingleton("adminhtml/session")->setStoresData($this->getRequest()->getPost());
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
						$model = Mage::getModel("locator/stores");
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
                      $model = Mage::getModel("locator/stores");
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
			$fileName   = 'stores.csv';
			$grid       = $this->getLayout()->createBlock('locator/adminhtml_stores_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
		} 
		/**
		 *  Export order grid to Excel XML format
		 */
		public function exportExcelAction()
		{
			$fileName   = 'stores.xml';
			$grid       = $this->getLayout()->createBlock('locator/adminhtml_stores_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
		}
}
