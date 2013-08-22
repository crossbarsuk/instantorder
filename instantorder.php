<?php
if (!defined('_PS_VERSION_'))
	exit;
Class InstantOrder extends Module{
	
	public function __construct(){
		
		$this->name = 'instantorder';
		$this->tab = 'Orders';
		$this->version = '1.0';
		$this->author = 'Mayas Haddad';
		$this->need_instance = 0;

		parent::__construct();

		$this->displayName = $this->l('Instant Order');
		$this->description = $this->l('A Prestashop new confirmed order hook module.');

	}

	public function install(){
		
		if(pareint::install() == false){
			return false;
		}
		return true;
	}

	public function uninstall(){
		
		if (!parent::uninstall())
		Db::getInstance()->Execute('DELETE FROM `'._DB_PREFIX_.'mymodule`');
		parent::uninstall();
	}
}