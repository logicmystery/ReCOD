<?php

class Help_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_help() {
        $DB2 = $this->load->database('node_db', TRUE);
        $DB2->select('*');
        $DB2->from('helps');
        //$DB2->where('id', 25);
        $query = $DB2->get();
        $result = $query->result_array();
        return $result;
    }

}

?>