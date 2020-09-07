<?php

/**
 *
 * @author kallol
 */
class Menus_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'menus';
        $this->check();
    }

    public function install() {
        $this->db->query("CREATE TABLE `menus` (
  `menu_ID` int(11) NOT NULL,
  `menu_name` varchar(30) NOT NULL,
  `menu_parent_id` int(11) NOT NULL,
  `menu_link` varchar(30) NOT NULL,
  `menu_icon_class` varchar(100) NOT NULL,
  `menu_admin_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

        $this->db->query("INSERT INTO `menus` (`menu_ID`, `menu_name`, `menu_parent_id`, `menu_link`, `menu_icon_class`, `menu_admin_type_id`) VALUES
(1, 'Management', 0, '', 'icon icon-black icon-briefcase', 2),
(2, 'admins', 1, 'admin', 'icon icon-black icon-user', 2),
(3, 'Uset Type', 1, 'admin_type', 'icon icon-black icon-users', 2)");

        $this->db->query("ALTER TABLE `menus`
  ADD PRIMARY KEY (`menu_ID`);
");

        $this->db->query("ALTER TABLE `menus`
  MODIFY `menu_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;");
    }

    /**
     * get the list of all data in table 
     */
}

?>
