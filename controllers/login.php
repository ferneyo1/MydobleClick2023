<?php

class Login extends Controller {

    function __construct() {
        parent::__construct();    
    }
    
    function index() 
    {    
        $this->view->render('login/index');
    }
    
    function run()
	{
         if($this->model->run()==1){
		header("location: " . URL . "index/");
	}
	else{
		header("location: " . URL . "login/");
	}
}
}
?>