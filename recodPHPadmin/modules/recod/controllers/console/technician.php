<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Technician extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->targetModel = 'technicians_model';
        $this->moduleMeta = array('recod' => 'technicians');
        $this->page_config['use_dropdown_columns'] = 'technicians_status';
        $this->page_config['use_dropdown_columns_options']['technicians_status'] =array('0'=>"INACTIVE","1"=>"ACTIVE");
        $this->page_config['tablePrimaryKey'] = $this->{$this->targetModel}->get_primary_key(); //pk
        $this->page_config['title'] = 'Technicians'; //search title bar
        $this->page_config['searchFields'] ="technician_name,technician_ID";
        $this->page_config['list_columns'] = $this->page_config['searchFields'];
	
	}
        /*         * end page_config* */
    }
