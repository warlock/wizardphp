<?php
class indexController extends Controller
{
	public function __construct() {
		parent::__construct();
	}
	
	public function index()
	{
		$this->_view->assign('welcome', 'Welcome to Wizard');
		$this->_view->render('index');
	}
}
?>