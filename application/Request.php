<?php
class Request
{
	private $_controller;
	private $_method;
	private $_args;
	public function __construct() {
		if(isset($_GET['url'])) {
			$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
			$url = explode('/', $url);
			$url = array_filter($url);
			
			$this->_controller = strtolower(array_shift($url));
			$this->_method = strtolower(array_shift($url));
			$this->_args = $url;
		}

		
		if(!$this->_controller) {
			$this->_controller = DEFAULT_CONTROLLER;
		}
		
		if(!$this->_method) {
			$this->_method = 'index';
		}
		
		if(!isset($this->_args)) {
			$this->_args = array();
		}
	}
	
	public function getController()
	{
		return $this->_controller;
	}
	
	public function getMethod()
	{
		return $this->_method;
	}
	
	public function getArgs()
	{
		return $this->_args;
	}	
}
?>