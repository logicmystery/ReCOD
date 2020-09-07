<?php

/**
 * Description of Modules_model
 *
 * @author kallol
 */
class Modules_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'modules';
        $this->check();
    }

    public function install() {
        $this->db->query("CREATE TABLE `modules` (
  `module_ID` int(11) NOT NULL,
  `module_name` varchar(50) NOT NULL,
  `module_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");



        $this->db->query("ALTER TABLE `modules`
  ADD PRIMARY KEY (`module_ID`);");

        $this->db->query("ALTER TABLE `modules`
  MODIFY `module_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;");
    }

    /**
     * get the list of all data in table 
     */
    public function widgets() {
        return $this->get_list_for_dropdown('module_name');
    }

    public function get_mod_name() {
       
        $CI = &get_instance();
        $this->db2=$CI->load->database('node_db', TRUE);
        $query = $this->db2->query("SELECT `node_module`,`node_status` FROM `nodes` where `node_status`=1 AND node_url='".$_SERVER['HTTP_HOST']."'")->result_array();
        return $query;
    }

}

?>
