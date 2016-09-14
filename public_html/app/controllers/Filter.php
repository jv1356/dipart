<?php

require_once 'Controller.php';

class Filter extends Controller{


	public function __construct(){
		

	}

	public function get() {
		if($_SESSION['filter'] == "ALL"){
			$_SESSION['filter'] = "SFW";
		} 
		elseif($_SESSION['filter'] == "SFW") {
			$_SESSION['filter'] = "ALL";
		}
		Functions::redirect("/");
	}

	public function post() {

	}



}