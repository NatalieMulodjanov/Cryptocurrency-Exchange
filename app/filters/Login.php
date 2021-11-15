<?php

namespace app\filters;

#[\Attribute]
class Login	{
	function execute(){
		if(!isset($_SESSION['user_id'])){
			header('location:'.BASE.'User/login');
			return true;
		}
		return false;
	}
}
