<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->targetModel = 'users_model';
        $this->moduleMeta = array('recod' => 'user');

        $this->page_config['title'] = 'User Record'; //search title bar
        $this->page_config['searchFields'] = 'user_name,user_phone,user_aadhar'; //search box,
        $this->page_config['list_columns'] ='user_name,user_email,user_phone,user_aadhar';
              /*         * end page_config* */
    }
    
 	
}
