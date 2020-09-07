<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @author Kallol
 */
class Admin extends MY_Controller {

    //put your code here
    public $publicAccess = array('login', 'applogin');

    public function __construct() {
        parent::__construct();
        $this->targetModel = 'admins_model';

        $this->page_config['use_status_columns'] = 'admin_status';
        $this->page_config['datepicker_columns'] = 'admin_registered';

        $this->page_config['use_image_columns'] = 'admin_image';
        $this->page_config['use_image_columns_path'] = base_url() . 'uploads/' . NODE . '/';


        $this->page_config['tablePrimaryKey'] = $this->admins_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'admins'; //search title bar
        $this->page_config['searchFields'] = 'admin_firstname,admin_lastname'; //search box,
        $this->page_config['list_columns'] = 'admin_firstname,admin_lastname,admin_image,admin_email,admin_status';
        $this->page_config['use_dropdown_columns'] = 'admin_type_id';
        $this->page_config['use_dropdown_columns_options']['admin_type_id'] = $this->admin_types_model->get_list_for_dropdown('admin_type_name');
        //$this->page_config['readonly_columns'] = 'admin_registered';
        /*         * end page_config* */
    }

    /**
     * delete
     */

    /**
     * view detail
     */
    public function view_detail() {

        $entryID = trim($this->input->post('entry'));
        $entryData1 = $this->admins_model->get_field_list();
        $entryData2 = $this->admins_model->get_list(array($this->page_config['tablePrimaryKey'] => $entryID));
        $entryData = array_intersect_key($entryData2[0], $entryData1[0]);

        echo $this->generate_detail_view($entryData, $this->page_config, 'admin_profile_tpl');
    }

    /**
     * non generic functions
     * * */
    public function profile() {
        if ($this->input->post('entry') != NULL)
            $entryID = trim($this->input->post('entry'));
        else
            $entryID = $this->current_admin_session['admin_ID'];

        $entryData1 = $this->admins_model->get_field_list();
        $entryData2 = $this->admins_model->get_list(array($this->page_config['tablePrimaryKey'] => $entryID));
        $entryData = array_intersect_key($entryData2[0], $entryData1[0]);
        unset($entryData['admin_pass']);
        // $entryData = array_merge($entryData, $this->policies_model->policy_status($entryID));

        $data['viewData'] = $this->generate_detail_view($entryData, $this->page_config, 'admin_profile_tpl');
        if ($this->input->post('entry') != NULL) {
            echo $data['viewData'];
            return;
        }
        $this->render($data);
    }

    /**
     * edit detail
     */
    public function edit_profile() {
        $postedData = $this->input->post();
        if (isset($postedData['load_edit_entry'])) {
            $entryData1 = $this->admins_model->get_field_list();
            $entryData2 = $this->admins_model->get_list(array($this->page_config['tablePrimaryKey'] => $this->current_admin_session['admin_ID']));
            $entryData = array_intersect_key($entryData2[0], $entryData1[0]);
            echo $this->generate_form_view($entryData, $this->page_config);
        } else {
            if ($postedData) {
                $postedData['admin_status'] = isset($postedData['admin_status']) ? 1 : 0;
                $this->admins_model->update_data($postedData, array($this->page_config['tablePrimaryKey'] => $this->current_admin_session['admin_ID']));
                //   $this->set_admin_session(19);
                echo json_encode(array('status' => 'success', 'message' => 'your data is updated!!!'));
            }
        }
    }

    public function applogin() {
        $this->set_admin_session($this->uri->segment(4));
        redirect(console_url());
    }

    public function login() {
        //die(console_url());

        $postedData = $this->input->post();

        if ($postedData) {
           
            $adminData = $this->admins_model->get_list(
                    array(
                        'admin_login' => trim($postedData['adminname']),
                        'admin_pass' => trim($postedData['password']),
                        
                    )
            );
            if ($adminData) {
               
                if ($adminData[0]['admin_status'] == 1) {
                    $this->set_admin_session($adminData[0]['admin_ID']);
                    echo json_encode(array('loginadmin' => $adminData[0]['admin_ID'], 'status' => 'success', 'message' => 'Login Success!!Please Wait..'));
                } else {
                    echo json_encode(array('status' => 'error', 'message' => 'admin is Inactive'));
                }
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Login Failed'));
            }
        } else {
            if ($this->current_admin_session)
                redirect(console_url());
                $this->render();
        }
    }

    public function logout() {
        $this->session->unset_userdata('current_admin_session');
        if ($this->input->post()) {
            echo json_encode(array('status' => 'success', 'message' => 'LogOut Success!!Please Wait..'));
        } else {
            redirect(console_url() . 'admin/login');
        }
    }

    public function signup() {
        $data = array('title' => 'Sign up');
        $postedData = $this->input->post();
        if ($postedData) {


            $adminData = array(
                's_email' => trim($postedData['email']),
                's_name' => trim($postedData['name']),
                'txt_password' => trim($postedData['password']),
                's_uid' => random_string('unique', 10)
            );
            $last_inserted_id = $this->admins_model->insert_data($adminData);
            if ($last_inserted_id) {
                $adminData = $this->admins_model->get_list(array('i_id' => $this->db->insert_id()));
                $this->session->set_userdata('current_admin_session', $adminData);
                echo json_encode(array('status' => 'success', 'message' => 'Success'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Fatal Error'));
            }
        } else {
            $data['captchaImage'] = $this->refresh_captcha(true);
            $this->render($data);
        }
    }

    public function captcha_check() {
        // First, delete old captchas
        $expiration = time() - 7200; // Two hour limit
        $this->db->query("DELETE FROM captcha WHERE captcha_time < " . $expiration);

        // Then see if a captcha exists:
        $sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
        $binds = array($this->input->post('captcha'), $this->input->ip_address(), $expiration);
        $query = $this->db->query($sql, $binds);
        $row = $query->row();

        if ($row->count == 0) {
            echo json_encode(array('status' => 'failed'));
        } else {
            echo json_encode(array('status' => 'success'));
        }
    }

    public function refresh_captcha($returnData = false) {
        $this->load->helper('captcha');
        $vals = array(
            //'word'	 => 'test',
            'img_path' => BASEPATH . '../images/captcha/',
            'img_url' => console_url() . 'images/captcha/',
            //'font_path'	 => './path/to/fonts/texb.ttf',
            'img_width' => '150',
            'img_height' => 30,
            'expiration' => 7200
        );


        $cap = create_captcha($vals);
        $data = array(
            'captcha_time' => $cap['time'],
            'ip_address' => $this->input->ip_address(),
            'word' => $cap['word']
        );

        $query = $this->db->insert_string('captcha', $data);
        $this->db->query($query);

        if ($returnData)
            return $cap['image'];
        else
            echo $cap['image'];
    }

    public function duplicate_check() {
        $postedItem = $this->input->post('duplicate');
        $isExist = $this->admins_model->count_total(array('s_email' => trim($postedItem)));
        if ($isExist) {
            echo json_encode(array('status' => 'error', 'message' => 'Email is already registered'));
        } else {
            echo json_encode(array('status' => 'success', 'message' => 'Email is not registered'));
        }
    }


}

?>
