<?php

class Istreet_Locator_IndexController extends Mage_Core_Controller_Front_Action
{
    public function IndexAction()
    {

        $this->loadLayout();
        $this->getLayout()->getBlock("head")->setTitle($this->__("Stockists"));
        $breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
        $breadcrumbs->addCrumb("home", array(
            "label" => $this->__("Home"),
            "title" => $this->__("Home"),
            "link" => Mage::getBaseUrl()
        ));

        $breadcrumbs->addCrumb("titlename", array(
            "label" => $this->__("Stockists"),
            "title" => $this->__("Stockists")
        ));

        $this->renderLayout();

    }
}