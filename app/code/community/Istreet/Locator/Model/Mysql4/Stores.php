<?php
class Istreet_Locator_Model_Mysql4_Stores extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("locator/stores", "id");
    }
}