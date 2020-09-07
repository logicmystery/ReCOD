<?php

/**
 * Description of Site_settings_model
 *
 * @author admin
 */
class Admin_types_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'admin_types';
        $this->check();
    }

    public function install() {
       $this->db->query("CREATE TABLE `admin_types` (
                    `admin_type_ID` int(11) NOT NULL,
                    `admin_type_name` varchar(50) NOT NULL,
                    `admin_type_super` tinyint(1) NOT NULL DEFAULT '0'
                  ) ENGINE=InnoDB DEFAULT CHARSET=latin1
               ");
        
        $this->db->query("ALTER TABLE `admin_types` ADD PRIMARY KEY (`admin_type_ID`);");        
        $this->db->query("ALTER TABLE `admin_types` MODIFY `admin_type_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;");
		$this->db->query("INSERT INTO `admin_types` (`admin_type_ID`, `admin_type_name`,`admin_type_super`) VALUES (1, 'admin',1) ");

    }

    /**
     * get the list of all data in table 
     */
}

?>
