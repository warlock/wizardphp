<?php
abstract class Controller
{
	protected $_view;
	
	public function __construct() {
		$this->_view = new View(new Request);
	}
	
	abstract public function index();
	
	protected function loadModel($model)
	{
		$model = $model . 'Model';
		$routeModel = ROOT . 'models' . DS . $model . '.php';
		if(is_readable($routeModel)) {
			require_once $routeModel;
			$model = new $model;
			return $model;
		} else {
			throw new Exception('Error de modelo');
		}
	}
	
	protected function getLibrary($library)
	{
		$routelibrary = ROOT . 'libs' .DS . $library . '.php';
		if(is_readable($routelibrary)) {
			require_once $routelibrary;
		} else {
			throw new Exception('Error de libreria');
		}
	}
	
	protected function getText($key)
	{
		if(isset($_POST[$key]) && !empty($_POST[$key])) {
			$_POST[$key] = htmlspecialchars($_POST[$key], ENT_QUOTES);
			return $_POST[$key];
		}
		return '';
	}
	
	protected function getInt($key)
	{
		if(isset($_POST[$key]) && !empty($_POST[$key])) {
			$_POST[$key] = filter_input(INPUT_POST, $key, FILTER_VALIDATE_INT);
			return $_POST[$key];
		}
		return 0;	
	}
	
	protected function redirect($route = false)
	{
		if($route) {
			header('location:' . BASE_URL . $route);
			exit;
		} else {
			header('location:' . BASE_URL);
			exit;
		}
	}

	protected function filterInt($int)
	{
		$int = (int) $int;
		if(is_int($int)) {
			return $int;
		} else {
			return 0;
		}
	}
	
	protected function getPostParam($key)
	{
		if(isset($_POST[$key])) {
			return $_POST[$key];
		}
	}
	
	protected function getSql($key)
    {
    	if(isset($_POST[$key]) && !empty($_POST[$key])){
            $_POST[$key] = strip_tags($_POST[$key]);
            if(!get_magic_quotes_gpc()){
                $_POST[$key] = mysql_escape_string($_POST[$key]);
            }
            
            return trim($_POST[$key]);
        }
    }
    
    protected function getAlphaNum($key)
    {
        if(isset($_POST[$key]) && !empty($_POST[$key])){
            $_POST[$key] = (string) preg_replace('/[^A-Z0-9_]/i', '', $_POST[$key]);
            return trim($_POST[$key]);
        }
        
    }
    
    public function validateMail($mail)
    {
	    if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
		    return false;
	    }
	    
	    return true;
    }
}
?>