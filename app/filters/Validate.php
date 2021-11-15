<?php

namespace app\filters;

#[\Attribute]
class Validate	{
	function execute(){
		if(isset($_SESSION['secretkey']) && ($_SESSION['secretkey']!='')){
			header('location:'.BASE.'User/validateSecretKey');
			return true;
		}
		return false;
	}
}
