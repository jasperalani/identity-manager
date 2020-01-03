<?php

include_once 'php/includes.php';

if(isset($_COOKIE['loggedin'])){

	if(isset($_GET['addnew'])){

		include 'php/addnew.php';

	}else{

		include 'php/display.php';

	} 

}else{

	if(isset($_GET['signin'])){

		include 'php/signin.php';

	}else{

		include 'php/register.php';

	}

}

include 'html/close.php';