<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Institutions extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->targetModel = 'institutions_model';
        $this->moduleMeta = array('recod' => 'institution');

        $this->page_config['title'] = 'Institution Record'; //search title bar
        $this->page_config['searchFields'] = 'institution_name'; //search box,
        $this->page_config['list_columns'] ='institution_name,institution_status';
              /*         * end page_config* */
    }
    
 	
}
