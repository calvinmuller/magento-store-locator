<?php
$installer = $this;
$installer->startSetup();
$sql = <<<SQLTEXT
create table stores(
    id int not null auto_increment, 
    name varchar(100),
    address varchar(100),
    trading_hours varchar(100),
    latitute decimal(10,5),
    longitude decimal(10,5),
    primary key(id)
);
		
SQLTEXT;

$installer->run($sql);
//demo 
//Mage::getModel('core/url_rewrite')->setId(null);
//demo 
$installer->endSetup();
	 