<?php


/**
 *
 * @author kallol
 */
class Admins_model extends MY_Model
{

    //put your code here

    public $table_name;

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'admins';
        $this->joiningArray[0]['table'] = 'admin_types';
        $this->joiningArray[0]['condition'] = 'admin_types.admin_type_ID = admins.admin_type_id';
        $this->check();
    }
    public function install()
    {
        $query = $this->db->query("CREATE TABLE `admins` (
  `admin_ID` bigint(20) UNSIGNED NOT NULL,
  `admin_login` varchar(60) NOT NULL DEFAULT '',
  `admin_pass` varchar(64) NOT NULL DEFAULT '',
  `admin_firstname` varchar(50) NOT NULL DEFAULT '',
  `admin_lastname` varchar(50) NOT NULL,
  `admin_email` varchar(100) NOT NULL DEFAULT '',
  `admin_status` int(11) NOT NULL DEFAULT '0',
  `admin_type_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");


        $this->db->query("ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_ID`),
  ADD KEY `admin_login_key` (`admin_login`)");
        $this->db->query("ALTER TABLE `admins`
  MODIFY `admin_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;");

        $this->db->query("INSERT INTO `admins` 
   (`admin_ID`, `admin_login`, `admin_pass`, `admin_firstname`, `admin_lastname`,`admin_email`,`admin_status`, `admin_type_id`) VALUES
	(1, 'admin', 'admin123', 'System', 'Admin', 'simplebillings@logicmystery.com', 1, 1);
	");
    }

    /**
     * get the list of all data in table 
     */
}
