<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @author Kallol
 */
class Admin_type extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();

        $this->targetModel = 'admin_types_model';
        $this->page_config['tablePrimaryKey'] = $this->admin_types_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'admin Type'; //search title bar
        $this->page_config['searchFields'] = 'admin_type_name'; //search box,

        /*         * end page_config* */
    }

 
    //---------------------------------------------------------------
    /**
     * non generic functions
     * * */
}

?>
