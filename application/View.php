<?php

require_once ROOT . 'libs' . DS . 'smarty' . DS . 'Smarty.class.php';

class View extends Smarty
{
	private $_controller;
	private $_js;
	public function __construct(Request $request) {
		parent::__construct();
		$this->_controller = $request->getController();
		$this->_js = array();
	}
	public function render($view, $item = false)
	{
		$this->template_dir = ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS;
		$this->config_dir = ROOT . 'views' . DS . 'layout' . DEFAULT_LAYOUT . DS . 'configs' . DS;
		$this->cache_dir = ROOT . 'tmp' . DS . 'cache' . DS;
		$this->compile_dir = ROOT . 'tmp' . DS . 'template' . DS;	
		
		$js = array();
		
		if(count($this->_js)) {
			$js = $this->_js;
		}
	
		$_params = array(
			'css_route' => BASE_URL . 'views/layout/' .  DEFAULT_LAYOUT . '/css/',
			'img_route' => BASE_URL . 'views/layout/' .  DEFAULT_LAYOUT . '/img/',
			'js_route' => BASE_URL . 'views/layout/' .  DEFAULT_LAYOUT . '/js/',
			'menu' => $menu,
			'item' => $item,
			'js' => $js,
			'root' => BASE_URL,
			'config' => array(
				'app_name' => APP_NAME,
				'app_slogan' => APP_SLOGAN,
				'app_company' => APP_COMPANY
			)

		);

		$routeView = ROOT . 'views' . DS . $this->_controller . DS . $view . '.tpl';
		
		if(is_readable($routeView)) {
			$this->assign('_content', $routeView);
		} else {
			throw new Exception('Error de vista');
		}
		
		$this->assign('_layoutParams', $_params);
		$this->display('template.tpl');
	}
	
	public function setJs(array $js)
	{
		if(is_array($js) && count($js)) {
			for ($i=0; $i < count($js); $i++) {
				$this->_js[] = BASE_URL . 'views/' . $this->_controller . '/js/' . $js[$i] . '.js';
			}
		} else {
			throw new Exception('Error de js');
		}
	}
	
}
?>