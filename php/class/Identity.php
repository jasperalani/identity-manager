<?php

class Identity {

	public $Id;
	public $Name;
	public $Username;
	public $Region;
	public $Birthdate;

	public function __construct($Id, $Name, $Username, $Region, $Birthdate){
		$this->Id = $Id;
		$this->Name = $Name;
		$this->Username = $Username;
		$this->Region = $Region;
		$this->Birthdate = $Birthdate;
	}

}