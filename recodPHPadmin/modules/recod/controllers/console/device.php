<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Device extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->targetModel = 'devices_model';
        $this->moduleMeta = array('recod' => 'device');

        $this->page_config['title'] = 'Device Record'; //search title bar
        $this->page_config['searchFields'] = 'device_lat,device_long,device_status'; //search box,
        $this->page_config['list_columns'] ='device_lat,device_long,device_status';
              /*         * end page_config* */
    }
    
 	
}
