<?php

class Technicians_model extends MY_Model {

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'technicians';
    }

}

?>
