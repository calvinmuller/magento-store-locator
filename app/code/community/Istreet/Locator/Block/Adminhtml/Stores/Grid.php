<?php

class Istreet_Locator_Block_Adminhtml_Stores_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("storesGrid");
				$this->setDefaultSort("id");
				$this->setDefaultDir("DESC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("locator/stores")->getCollection();
				$this->setCollection($collection);
				return parent::_prepareCollection();
		}
		protected function _prepareColumns()
		{
				$this->addColumn("id", array(
				"header" => Mage::helper("locator")->__("ID"),
				"align" =>"right",
				"width" => "50px",
			    "type" => "number",
				"index" => "id",
				));
                
				$this->addColumn("name", array(
				"header" => Mage::helper("locator")->__("Name"),
				"index" => "name",
				));
				$this->addColumn("address", array(
				"header" => Mage::helper("locator")->__("Address"),
				"index" => "address",
				));
				$this->addColumn("latitude", array(
				"header" => Mage::helper("locator")->__("Latitiude"),
				"index" => "latitude",
				));
				$this->addColumn("longitude", array(
				"header" => Mage::helper("locator")->__("Longitude"),
				"index" => "longitude",
				));
				$this->addColumn("enabled", array(
				"header" => Mage::helper("locator")->__("Enabled"),
				"index" => "enabled",
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
			$this->getMassactionBlock()->addItem('remove_stores', array(
					 'label'=> Mage::helper('locator')->__('Remove Stores'),
					 'url'  => $this->getUrl('*/adminhtml_stores/massRemove'),
					 'confirm' => Mage::helper('locator')->__('Are you sure?')
				));
			return $this;
		}
			

}