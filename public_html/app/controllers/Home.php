<?php

require_once 'Controller.php';
require_once 'core/Functions.php';

class Home extends Controller{


	public function __construct(){
		

	}

	public function post() {

	}

	public function get() {
		$this->render("home.view.php");
	}



}