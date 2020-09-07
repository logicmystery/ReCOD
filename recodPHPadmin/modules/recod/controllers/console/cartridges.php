
<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cartridges extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->targetModel = 'cartridges_model';
        $this->moduleMeta = array('recod' => 'cartridge');
        $this->page_config['use_dropdown_columns']='cartridge_institute';
        $this->page_config['use_dropdown_columns_options']['cartridge_institute'] = $this->institutions_model->get_list_for_dropdown('institution_name');
        $this->page_config['title'] = 'Cartridges Record'; //search title bar
        $this->page_config['searchFields'] = 'institution_name'; //search box,
        $this->page_config['list_columns'] ='institution_name';
              /*         * end page_config* */
    }
    
 	
}
