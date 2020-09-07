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
class Help extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        }
        
        public function index() {
            $this->load->model('help_model');
                    $sql= $this->db->query("select module_name from modules")->result_array();
                    foreach ($sql as $key => $value) {
                        $data['module'][$key+1]=$value['module_name'];
                    }
                    $data['help_data']=$this->help_model->get_help();
                   // pr($data);
            $this->render($data,'help_tpl');
            
        }

}?>