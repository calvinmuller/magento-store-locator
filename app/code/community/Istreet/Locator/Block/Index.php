<?php

class Istreet_Locator_Block_Index extends Mage_Core_Block_Template
{


    /**
     * Get all stores
     * @return object
     */
    public function getStores()
    {
        return Mage::getModel('locator/stores')->getCollection();
    }

}