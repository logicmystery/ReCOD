<?php

class Cartridges_model extends MY_Model {

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'cartridges';
        $this->joiningArray[0]['table'] = 'institutions';
        $this->joiningArray[0]['condition'] = 'cartridges.cartridge_institute = institutions.institute_ID';
    }

}

?>
