<?php
$installer = $this;
$installer->startSetup();
$sql=<<<SQLTEXT
create table callbacks(id int not null auto_increment, name varchar(100), phone varchar(30),email varchar(30),status int(1),message varchar(1000), created_time date, primary key(id));
 
		
SQLTEXT;

$installer->run($sql);

$installer->endSetup();
	 
