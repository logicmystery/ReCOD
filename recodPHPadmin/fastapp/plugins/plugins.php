<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of test
 *
 * @author kallol
 */
class Plugins {

    //put your code here
    public function pre_system($param) {
        // echo 'pre_system';
        //print_r($param);
    }

    //put your code here
    public function pre_controller($param) {
        // echo 'pre_controller';
        //print_r($param);
    }

    //put your code here
    public function post_controller_constructor($param) {
        //echo 'post_controller_constructor';
        //print_r($param);
    }

    //put your code here
    public function post_controller($param) {
        //echo 'post_controller';
        //print_r($param);
        
    }

    public function display_override($param) {
        $this->CI = & get_instance();
        echo translateIt($this->CI->output->get_output());
    }

    public function cache_override($param) {
        //echo 'cache_override';
        //print_r($param);
    }

}

?>
