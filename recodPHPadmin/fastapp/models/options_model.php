<?php

/**
 *
 * @author kallol
 */
class Options_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'options';
       $this->check();
    }
 public function install() {
       $this->db->query("CREATE TABLE `options` (
  `option_ID` int(11) NOT NULL,
  `option_key` varchar(45) DEFAULT NULL,
  `option_value` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
");


        
        $this->db->query("ALTER TABLE `options`
  ADD PRIMARY KEY (`option_ID`),
  ADD UNIQUE KEY `option_key_UNIQUE` (`option_key`);
");
        
        $this->db->query("ALTER TABLE `options`
  MODIFY `option_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;");

        $this->db->query("INSERT INTO `options` ( `option_key`, `option_value`) VALUES
			('record_per_page', '20'),
			('site_title', 'Console Panel'),
			('site_description', 'Admin panel of the site'),
			('site_logo', '1492173636.png')
		");

    }

    public function get_option($param = NULL) {
        $valueArr = $this->get_list(array('option_key' => $param));
        return isset($valueArr[0]['option_value'])?$valueArr[0]['option_value']:NULL;
    }

    public function set_option($key = NULL, $value = NULL) {
        if (isset($key) && isset($value)) {
            if ($this->count_total(array('option_key' => $key)))
                return $this->update_data(array('option_value' => $value), array('option_key' => $key));
            else
                return $this->insert_data(array('option_value' => $value,'option_key' => $key));
        }
    }

    /**
     * get the list of all data in table 
     */
}

?>
