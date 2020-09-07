<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Test extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->targetModel = 'tests_model';
        $this->moduleMeta = array('recod' => 'test');

        // $this->page_config['use_dropdown_columns']='test_technician_id,test_user_id,test_device_id';
        // $this->page_config['use_dropdown_columns_options']['test_technician_id'] = $this->technicians_model->get_list_for_dropdown('technician_name');
        // $this->page_config['use_dropdown_columns_options']['test_user_id'] = $this->users_model->get_list_for_dropdown('user_name');
        // $this->page_config['use_dropdown_columns_options']['test_device_id'] = $this->devices_model->get_list_for_dropdown('device_lat');
        // $this->page_config['datetimepicker_columns'] = 'test_timestamp';
        $this->page_config['title'] = 'Test Record'; //search title bar
        $this->page_config['searchFields'] = 'test_technician_id,test_unique_catrage_no,test_patient_name,test_timestamp'; //search box,
        $this->page_config['list_columns'] = 'test_technician_id,test_unique_catrage_no,test_patient_name,test_timestamp';
              /*         * end page_config* */
    }
    
 	
}
