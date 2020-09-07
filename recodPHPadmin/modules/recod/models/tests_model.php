<?php

class Tests_model extends MY_Model {

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'tests';
        // $this->joiningArray[0]['table'] = 'users';
        // $this->joiningArray[0]['condition'] = 'tests.test_user_id = users.user_ID';
        //$this->check();
    }

}

?>
