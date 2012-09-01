<?php
class Bootstrap
{
	public static function run(Request $request)
	{
		$controller = $request->getController() . 'Controller';
		$routeController = ROOT . 'controllers' . DS . $controller . '.php';
		$method = $request->getMethod();
		$args = $request->getArgs();
		
		if (is_readable($routeController)) {
			require_once $routeController;
			$controller = new $controller;
			
			if(is_callable(array($controller, $method))) {
				$method = $request->getMethod();
			} else {
				$method = 'index';
			}
			
			if(isset($args)) {
				call_user_func_array(array($controller,$method), $args);
			} else {
				call_user_func(array($controller,$method));
			}
		} else {
			throw new Exception('Not found');
		}
	}
}
?>