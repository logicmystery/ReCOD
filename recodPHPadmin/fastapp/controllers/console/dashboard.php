<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed dc ');

class Dashboard extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

	 public function index(){
		  $this->render();
	 }


    public function sample() {
        $this->render();
		
    }

}
