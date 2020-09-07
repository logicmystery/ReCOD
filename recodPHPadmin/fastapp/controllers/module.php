<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed dc ');

class Module extends MY_Controller {

    public $publicAccess = array('index');

    public function __construct() {
        parent::__construct();
        
    }

    /**
     * 
     * take all 404 non default request pages 
     * /***
     * there is a need of modification
     */
    public function index() {
        /*         * get all active modules */
        /*         * *routing through console*** */
        if ($this->uri->segment(1) == 'console') {

            if (isset($this->moduleControllers['console'][$this->uri->segment(2)]['path'])) {
                require_once $this->moduleControllers['console'][$this->uri->segment(2)]['path'];
                $controller = $this->uri->segment(2);
                $action = $this->uri->segment(3);
                if ($action == '') {
                    $action = 'index';
                }


              //  pr($this->moduleControllers['console'][$this->uri->segment(2)]);
                $dynamicController = new $controller();
                
                $this->load->add_package_path(ROOTPATH . 'modules/' . $this->moduleControllers['console'][$this->uri->segment(2)]['module']);
                if (method_exists($dynamicController, $action)) {
                    $dynamicController->$action();
                } else {
                    show_404();
                }
            } else {
                show_404();
            }
        } else {
            /*             * *routing through non console*** */
            if (isset($this->moduleControllers['frontend'][$this->uri->segment(1)]['path'])) {
                require_once $this->moduleControllers['frontend'][$this->uri->segment(1)]['path'];
                $controller = $this->uri->segment(1);
                $action = $this->uri->segment(2);
                if ($action == '') {
                    $action = 'index';
                }
                $dynamicController = new $controller();
                $this->load->add_package_path(ROOTPATH . 'modules/' . $this->moduleControllers['frontend'][$this->uri->segment(1)]['module']);
                if (method_exists($dynamicController, $action)) {
                    $dynamicController->$action();
                } else {
                    /*                     * *no method found* */
                    show_404();
                }
            } else {
               
                /*                 * *neither front nor console* */
                execute_hook('cms');
            }
        }
    }

    /**
     * need to do seo url rewrite
     * 
     * * */
}
