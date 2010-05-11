<?php
class DataStore {
	public function __construct() {
    $this->textStore = '';
	}

	public function addText($msg) {
	  $this->textStore .= $msg;
	}

	public function storedText() {
    return $this->textStore;  
	}
}
?>