<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cronjob
 *
 * @author kallol
 */
class cronjob extends CI_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function initcorn() {
       $this->options_model->set_option('corn_time',  time());

    }
    
}
