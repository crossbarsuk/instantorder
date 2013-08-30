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
		
		return parent::install() && $this->registerHook('actionValidateOrder') && $this->registerHook('actionProductDelete');

	}

	public function uninstall(){
		
		if (!parent::uninstall())
		Db::getInstance()->Execute('DELETE FROM `'._DB_PREFIX_.'mymodule`');
		parent::uninstall();
	}

	public function getContent(){

	}
	
	public function hookActionValidateOrder($params){
		
		global $smarty;
		var_dump($params['id']);
		$r = new HttpRequest('http://localhost/MexicanMonkey/index.php', HttpRequest::METH_POST);
		//$r->setOptions(array('cookies' => array('lang' => 'de')));
		//$r->addPostFields(array('user' => 'mike', 'pass' => 's3c|r3t'));
		//$r->addPostFile('image', 'profile.jpg', 'image/jpeg');
		$r->addPostFields(array('from' => 'mike', 'to' => 's3c|r3t', 'origin' => 's3c|r3t', 'key' => 's3c|r3t'));
		try {
    		echo $r->send()->getBody();
		}catch (HttpException $ex) {
    	echo $ex;
   		 }
		return $this->display(__FILE__, 'instantorder.tpl');
	}

	public function hookActionProductDelete($params){
		global $smarty;
		return $this->display(__FILE__, 'instantorder.tpl');
	}
}