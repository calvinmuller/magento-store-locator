<?php


class Istreet_Locator_Block_Adminhtml_Stores extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct()
	{

	$this->_controller = "adminhtml_stores";
	$this->_blockGroup = "locator";
	$this->_headerText = Mage::helper("locator")->__("Stores Manager");
	$this->_addButtonLabel = Mage::helper("locator")->__("Add New Item");
	parent::__construct();
	
	}

}