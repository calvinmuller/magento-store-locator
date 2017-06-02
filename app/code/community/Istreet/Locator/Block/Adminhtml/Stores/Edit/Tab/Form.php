<?php

class Istreet_Locator_Block_Adminhtml_Stores_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {

        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset("locator_form", array("legend" => Mage::helper("locator")->__("Item information")));


        $fieldset->addField("name", "text", array(
            "label" => Mage::helper("locator")->__("Name"),
            "name" => "name",
        ));

        $fieldset->addField("address", "text", array(
            "label" => Mage::helper("locator")->__("Address"),
            "name" => "address",
        ));

        $fieldset->addField("trading_hours", "textarea", array(
            "label" => Mage::helper("locator")->__("Trading Hours"),
            "name" => "trading_hours",
        ));

        $fieldset->addField("latitute", "text", array(
            "label" => Mage::helper("locator")->__("Latitude"),
            "name" => "latitute",
        ));

        $fieldset->addField("longitude", "text", array(
            "label" => Mage::helper("locator")->__("Longitude"),
            "name" => "longitude",
        ));

        $fieldset->addField("enabled", "text", array(
            "label" => Mage::helper("locator")->__("Enabled"),
            "name" => "enabled",
        ));


        if (Mage::getSingleton("adminhtml/session")->getStoresData()) {
            $form->setValues(Mage::getSingleton("adminhtml/session")->getStoresData());
            Mage::getSingleton("adminhtml/session")->setStoresData(null);
        } elseif (Mage::registry("stores_data")) {
            $form->setValues(Mage::registry("stores_data")->getData());
        }
        return parent::_prepareForm();
    }
}
