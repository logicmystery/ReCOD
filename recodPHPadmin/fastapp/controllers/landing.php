<?php
class Landing extends MY_Controller {

    public $publicAccess = array('index');

    public function __construct() {
        parent::__construct();
        
    }
    
    public function index() {
        $landing_url = get_option('home_page');
        if(!empty($landing_url)){
            redirect(base_url($landing_url));
        } else {
            echo 'coming soon';
        }
    }
    
    public function test() {
        $this->render();
    }
}