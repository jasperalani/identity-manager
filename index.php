<?php

include_once 'php/includes.php';

if(isset($_GET['addnew'])){

	include 'php/addnew.php';

}else{

	$sql = "SELECT * FROM identities";

	$array = $conn->query($sql);
	// var_dump($array);

	if($array->num_rows >= 1) {
		while ($identity = $array->fetch_assoc()){
			$identities[] =
				new Identity($identity['id'], $identity['name'], $identity['username'], $identity['region'], $identity['birthdate']);
		}
	}

	include 'php/display.php';

} 

include 'html/close.php';

?>