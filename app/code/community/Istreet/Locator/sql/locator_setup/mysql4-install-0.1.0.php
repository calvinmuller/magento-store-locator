<?php
$installer = $this;
$installer->startSetup();
$sql=<<<SQLTEXT
create table stores(id int not null auto_increment, name varchar(100), primary key(tablename_id));
		
SQLTEXT;

$installer->run($sql);
//demo 
//Mage::getModel('core/url_rewrite')->setId(null);
//demo 
$installer->endSetup();
	 