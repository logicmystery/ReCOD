<?php

/**
 * Description of My_Controler
 * @package core
 * @author Kallol
 * @version 2.0
 * @dependent Model permission_model,site_settings_model,menus_model
 * @deprecated since version 1.0.2 dependent  Model 
 */
class MY_Controller extends CI_Controller
{

    protected $publicAccess, $validationRules, $moduleControllers,
        $allowed_action, $targetModel, $translator, $record_per_page = 15,
        $default_uri_segment = 4;
    public $moduleMenu, $current_admin_session,
        $current_site_settings, $routedirectory, $moduleMeta, $function_hook;

    public function __construct()
    {
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
        if ($this->input->get()) {
            $this->output->cache(60);
        }
        /***/
        $this->initilise();
        $this->access_control();
        $this->load_module_packages();
    }

    private function initilise()
    {
        /** populate basic site settings ans admin data to application wise */
        $this->current_admin_session = $this->session->userdata('current_admin_session');
        //$this->allowed_action = array('add_detail', 'edit_detail', 'delete', 'view_detail', 'quick_edit');
        $this->allowed_action = array('add_detail', 'edit_detail', 'delete', 'view_detail', '');
        $this->current_site_settings = $this->get_site_setting();
        $this->targetModel = $this->uri->segment(2) . 's_model';
    }

    /**
     * autoload module active module packages
     * with all models and helpers
     * *** */
    private function load_module_packages()
    {
        /** get the active modules */
        if (file_exists(ROOTPATH . 'fastapp/cachefiles/' . NODE . '/module.txt')) {
            $modules = json_decode(file_get_contents(ROOTPATH . 'fastapp/cachefiles/' . NODE . '/module.txt'), true);
        } else {
            // pr(PLAN_PACKAGES);
            $modules = explode(",", PLAN_PACKAGES);
            // $modules = $this->modules_model->get_list_for_dropdown('module_name', array('module_status' => 1));
            //pr($modules,1);

            file_put_contents(ROOTPATH . 'fastapp/cachefiles/' . NODE . '/module.txt', json_encode($modules));
        }
        foreach ($modules as $moduleMeta) {
            /*             * load the package */
            $this->load->add_package_path(ROOTPATH . "modules/" . $moduleMeta . '/');

            /** load frontend controller list only */
            if (get_dir_file_info(ROOTPATH . 'modules/' . $moduleMeta . '/controllers', TRUE))
                foreach (get_dir_file_info(ROOTPATH . 'modules/' . $moduleMeta . '/controllers', TRUE) as $value) {
                    if (strstr($value['name'], '.php', TRUE))
                        $this->moduleControllers['frontend'][strstr($value['name'], '.php', TRUE)] = array(
                            'module' => $moduleMeta,
                            'path' => $value['server_path']
                        );
                }

            /*             * load console controller list only */
            if (get_dir_file_info(ROOTPATH . 'modules/' . $moduleMeta . '/controllers/console', TRUE))
                foreach (get_dir_file_info(ROOTPATH . 'modules/' . $moduleMeta . '/controllers/console', TRUE) as $value) {
                    if (strstr($value['name'], '.php', TRUE))
                        $this->moduleControllers['console'][strstr($value['name'], '.php', TRUE)] = array(
                            'module' => $moduleMeta,
                            'path' => $value['server_path']
                        );
                }

            /*             * load models */
            if (get_dir_file_info(ROOTPATH . 'modules/' . $moduleMeta . '/models'))
                foreach (get_dir_file_info(ROOTPATH . 'modules/' . $moduleMeta . '/models') as $value) {
                    $this->load->model(strstr($value['name'], '.php', TRUE));
                }
            /*             * load helpers */
            if (get_dir_file_info(ROOTPATH . 'modules/' . $moduleMeta . '/helpers'))
                foreach (get_dir_file_info(ROOTPATH . 'modules/' . $moduleMeta . '/helpers') as $value) {
                    $this->load->helper(strstr($value['name'], '.php', TRUE));
                }
            /*             * remove packages for safe execution* */
            //$this->load->remove_package_path(ROOTPATH . "modules/" . $moduleMeta . '/');
        }
    }

    /**
     * prepare admin capability permission and access controle
     *      * @ticket:  $this->is_authorised malfunctionaing
     * * */
    private function access_control()
    {
        if (!$this->is_capabale()) {
            $this->show_error_page(403);
            exit();
        }
        $this->is_authorised();
    }

    /**
     * only for console capability check    
     *  */
    private function is_capabale()
    {
	if(isset($this->current_admin_session['admin_type_super']))
        if ($this->current_admin_session['admin_type_super'] == 1) {
            return true;
        }
        $controller = empty($this->uri->segment(2)) ? 'dashboard' : $this->uri->segment(2);
        $capability_list = json_decode(get_option('capability_' . $controller), true);
        if (!empty($capability_list))
             if(isset($capability_list['capability'][$controller][$this->current_admin_session['admin_type_id']])){
            $this->allowed_action = array_keys($capability_list['capability'][$controller][$this->current_admin_session['admin_type_id']]);
            }
        if (isset($this->uri->segments[1]) && $this->uri->segments[1] == 'console') {
            $verify_capable_action = isset($this->uri->segments[3]) ? $this->uri->segments[3] : $this->uri->rsegments[2];
			if(is_array($this->publicAccess)){	
				if (in_array($verify_capable_action, $this->publicAccess)) {
					return true;
				}
            }

            if ($verify_capable_action == 'capability_list')
                return true;
            if ($capability_list['capability'][$controller][$this->current_admin_session['admin_type_id']][$verify_capable_action] == 'true') {
                return TRUE;
            }
            $message = '<script>window.location="' . base_url('console_login') . '"</script>Please Wait...';
            show_error($message, '403', 'Not Authorised!! Please wait...');

            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function capability_list()
    {

        $this->page_config['use_dropdown_columns_options']['capability_admin_type'] = $this->admin_types_model->get_list_for_dropdown('admin_type_name',array("admin_type_super"=>0));
        $this->page_config['use_dropdown_columns_options']['capability_controller'] = $this->get_controllers();

        if (!$this->current_admin_session['admin_type_super']) {
            $message = '<script>window.location="' . base_url('console_login') . '"</script>Please Wait...';
            show_error($message, '403', 'Not Authorised!! Please wait...');
        }
        if ($this->input->post()) {
            $postedData = $this->input->post();
            set_option('capability_' . key($postedData['capability']), json_encode($postedData));
        }
        $choosenData = json_decode(get_option('capability_' . $this->uri->segment(2)), true);
        $viewData = $this->render(array('choosenData' => $choosenData), 'capability_list_tpl', true);

        $this->render(array('viewData' => $viewData));
    }

    private function get_controllers()
    {
        /*         * default controllers* */
        $files = get_dir_file_info(APPPATH . 'controllers', FALSE);
        $modules = $this->get_modules();
        foreach ($modules as $module) {
            if ($module != 'Default')
                $files = array_merge($files, get_dir_file_info(ROOTPATH . 'modules/' . $module . '/controllers', FALSE));
        }
        $controllers = NULL;
        // Loop through file names removing .php extension
        foreach (array_keys($files) as $file) {
            if ($file != 'index.html') {
                $controller = str_replace(EXT, '', $file);
                $controllers[$controller] = $controller;
            }
        }
        //pr($controller);
        return $controllers;
    }

    private function get_modules()
    {
      return explode(',',PLAN_PACKAGES);    
    }

    public function excel_convert()
    {

        $all_data = $this->{$this->targetModel}->get_list();

        foreach ($all_data as $key => $value) {
            $title_data[] = (array_keys($value));
            //array_push($all_data, $title_data);
            $reformatted_all_data = (array_merge($title_data, $all_data));

            //pr($reformatted_all_data,1);
            //load our new PHPExcel library
            $this->load->library('excel');
            //activate worksheet number 1
            $this->excel->setActiveSheetIndex(0);
            //name the worksheet
            $this->excel->getActiveSheet()->setTitle($this->page_config['title']);
            $this->excel->getActiveSheet()->fromArray($reformatted_all_data);

            $filename = $this->page_config['title'] . date("Y-m-d H:m:s") . 'sheet.xls'; //save our workbook as this file name
            ob_end_clean();
            header('Content-Type: application/vnd.ms-excel'); //mime type
            header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
            header('Cache-Control: max-age=0'); //no cache
            //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
            //if you want to save it as .XLSX Excel 2007 format

            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
            //force admin to download the Excel file without writing it to server's HD
            $objWriter->save('php://output');
            exit;
        }
    }

    private function breadcrumb_generator($segments)
    {
        $breadcrumb[ucwords(str_replace('_', ' ', $segments[1]))] = base_url('/' . $segments[1]);
        if ($segments[2] != 'index' && !empty($segments[2]))
            $breadcrumb[ucwords(str_replace('_', ' ', $segments[2]))] = base_url('/' . $segments[1] . '/' . $segments[2]);
        if ($segments[3] != 'index' && !empty($segments[3]))
            $breadcrumb[ucwords(str_replace('_', ' ', $segments[3]))] = base_url('/' . $segments[1] . '/' . $segments[2] . '/' . $segments[3]);
        return $breadcrumb;
    }

    /*     * *
     * Rendering default template and others.
     * Default : application/views/console/controller_name/method_name.tpl.php
     * For Popup window needs to include the main css and jquery exclusively.
     * 
     * @param string $view_file, ex- dashboard/report then looks like application/views/console/.$view_file.tpl.php
     * @param array $passedData, pass the data to view
     * @param boolean $returnData, ex- true if return the data as variable string , false to render general
     * @param string header view name  $header_tpl, ex- default is 'header.tpl'
     * @param string footer view name  $footer_tpl, ex- default is 'footer.tpl'
     */

    /*     * *
     * Rendering default template and others.
     * Default : application/views/console/controller_name/method_name.tpl.php
     * For Popup window needs to include the main css and jquery exclusively.
     * 
     * @param string $view_file, ex- dashboard/report then looks like application/views/console/.$view_file.tpl.php
     * @param array $passedData, pass the data to view
     * @param boolean $returnData, ex- true if return the data as variable string , false to render general
     * @param string header view name  $header_tpl, ex- default is 'header.tpl'
     * @param string footer view name  $footer_tpl, ex- default is 'footer.tpl'
     */

    protected function render($passedData = array(), $view_file = null, $returnData = FALSE, $header_tpl = 'common/header_tpl', $footer_tpl = 'common/footer_tpl')
    {
        try {
            $segments[3] = $this->router->fetch_method();
            $segments[2] = $this->router->fetch_class();
            $segments[1] = str_ireplace('/','',$this->router->fetch_directory()?$this->router->fetch_directory():$this->uri->segment(2));
            if($segments[1]==""){
                $segments[1] = $this->uri->segment(1);
            }
            if($segments[2]=="module"){
                $segments[2] = $this->uri->segment(2);
            }
            if ($segments[1] == 'console') {
                if (empty($segments[3])) {
                    $segments[3] = 'index';
                }
                if (empty($segments[2])) {
                    $segments[2] = 'dashboard';
                }
                $this->routedirectory = 'console/';
                if ($view_file == null)
                    $view_file_path = $segments[1] . '/' . $segments[2] . '/' . $segments[3] . '_tpl';
                else
                    $view_file_path = $segments[1] . '/' . $segments[2] . '/' . $view_file;
            } else {
                $this->routedirectory = '';
                $view_file_path = $segments[1] . '/' . $segments[2] . '_tpl';
            }

            $returnViewData = '';
            $passedData['current_admin_session'] = $this->current_admin_session;
            $passedData['site_settings'] = $this->current_site_settings;
            $passedData['site_menu'] = $this->menu_generater();
            $passedData['site_breadcrumb'] = $this->breadcrumb_generator($segments);


            /*             * **********
              header
             *              * ************ */
            if (!($header_tpl === FALSE))
                $returnViewData .= $this->load->view($this->routedirectory . $header_tpl, $passedData, $returnData);

            /*             * **********
              view file detection and load
             * ************ */           
            if (isset($this->moduleControllers['console'][$this->uri->segment(2)]['module'])) {
                if (!get_file_info(ROOTPATH . 'modules/' . $this->moduleControllers['console'][$this->uri->segment(2)]['module'] . '/views/' . $view_file_path . '.php')) {
                    $view_file_path = str_ireplace($this->uri->segment(2) . '/', '', $view_file_path);
                }
            } else {
                if (!get_file_info(APPPATH . 'views/' . $view_file_path . '.php')) {
                    $view_file_path = str_ireplace($this->uri->segment(2) . '/', '', $view_file_path);
                    if (!get_file_info(APPPATH . 'views/' . $view_file_path . '.php')) {
                        $view_file_path = str_ireplace('elements' . '/', '', $view_file_path);
                    }
                }
            }
            $returnViewData .= $this->load->view($view_file_path, $passedData, $returnData);
            /*             * **********
              footer
             *              * ************ */
            if (!($footer_tpl === FALSE)) {
                $returnViewData .= $this->load->view($this->routedirectory . $footer_tpl, $passedData, $returnData);
            }
            return $returnViewData;
        } catch (Exception $err_obj) {
            $this->show_error_page(600, $err_obj->getMessage());
        }
    }

    protected function get_site_setting($reset = false)
    {
        if ($reset == true) {
            unlink(ROOTPATH . 'fastapp/cachefiles/' . NODE . '/site_setting.txt');
        }
        if (file_exists(ROOTPATH . 'fastapp/cachefiles/' . NODE . '/site_setting.txt')) {
            $site_setting = json_decode(file_get_contents(ROOTPATH . 'fastapp/cachefiles/' . NODE . '/site_setting.txt'), true);
        } else {
            $site_setting['site_setting_record_per_page'] = intval(get_option('record_per_page'));
            $site_setting['site_setting_status'] = intval(get_option('site_status'));
            $site_setting['site_setting_analytics'] = get_option('site_analitics');
            $site_setting['site_setting_copyright'] = get_option('site_copyright');
            $site_setting['site_setting_title'] = get_option('site_title');
            $site_setting['site_setting_description'] = get_option('site_description');
            $site_setting['site_setting_logo'] = get_option('site_logo');
            $site_setting['site_setting_fav'] = get_option('site_fav');
            $site_setting['site_setting_welcome_text'] = get_option('site_welcome_text');

            file_put_contents(ROOTPATH . 'fastapp/cachefiles/' . NODE . '/site_setting.txt', json_encode($site_setting));
        }

        return $site_setting;
    }


    protected function sendmail($mailMeta, $printDebug = FALSE, $use_defined_config = NULL)
    {

        $this->load->library('email');
        /*         * send mail config* */
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp.logicmystery.com';
        $config['smtp_admin'] = 'no-reply@logicmystery.com';
        $config['smtp_pass'] = 'dHpR(zu5';

        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        if (is_array($use_defined_config))
            $config = array_merge($config, $use_defined_config);
        $this->email->initialize($config);
        /*         * send mail config* */

        /*         * mail formating* */
        if (!isset($mailMeta['from']['email'])) {
            $mailMeta['from']['email'] = 'no-reply@logicmystery.com';
        }

        if (!isset($mailMeta['from']['name'])) {
            $mailMeta['from']['name'] = 'Do not Reply';
        }

        $this->email->from($mailMeta['from']['email'], isset($mailMeta['from']['name']) ? $mailMeta['from']['name'] : NULL);
        if (isset($mailMeta['reply_to']['email']))
            $this->email->reply_to($mailMeta['reply_to']['email'], isset($mailMeta['reply_to']['name']) ? $mailMeta['reply_to']['name'] : NULL);

        if (isset($mailMeta['to']))
            $this->email->to($mailMeta['to']);

        if (isset($mailMeta['cc']))
            $this->email->cc($mailMeta['cc']);

        if (isset($mailMeta['bcc']))
            $this->email->bcc($mailMeta['bcc']);

        $this->email->subject(isset($mailMeta['subject']) ? $mailMeta['subject'] : '');
        $this->email->message(isset($mailMeta['body']) ? $mailMeta['body'] : '');

        $sendMailStatus = $this->email->send();
        if ($printDebug)
            echo $this->email->print_debugger();
        return $sendMailStatus;
    }

    /**
     * need modification
     */
    private function is_authorised($allowed_action = NULL)
    {
        /*         * *
         * public access set in controllers
         */
        if (isset($this->publicAccess)) {
            if (is_array($this->publicAccess) && array_search($this->router->method, $this->publicAccess) !== FALSE) {
                return TRUE;
            } else {
                if ($this->publicAccess == '*')
                    return TRUE;
            }
        }

        /**
         * check if admin is login or not
         * * */
        if (isset($this->current_admin_session['admin_ID'])) {
            if ($allowed_action) {
                if (array_search($this->router->method, $allowed_action) !== FALSE) {
                    return TRUE;
                } else {
                    $this->show_error_page(403);
                    return false;
                }
            }
            return true;
        } else {
            //redirect(base_url());
            $this->show_error_page(401);
            return false;
        }
    }

    /**
     * generate view for index listing table 
     */
    protected function generate_table_view($data = NULL, $admin_config = array(), $view_template = 'elements/table_tpl')
    {
        /** auto field type detect Start* */
        $config = $this->auto_fieldtype_detect($admin_config);
        /** auto field type detect End* */
        $config['enable_pagination'] = isset($admin_config['enable_pagination']) ? $admin_config['enable_pagination'] : TRUE;
        $config['base_url'] = isset($admin_config['base_url']) ? $admin_config['base_url'] : console_url() . $this->uri->segment(2) . '/' . $this->router->method . '/';
        $config['total_rows'] = isset($data['total_rows']) ? $data['total_rows'] : 0;
        $config['per_page'] = isset($data['per_page']) ? $data['per_page'] : $this->current_site_settings['site_setting_record_per_page'];
        $config['uri_segment'] = isset($admin_config['uri_segment']) ? $admin_config['uri_segment'] : $this->default_uri_segment;
        $config['is_ajax'] = isset($admin_config['is_ajax']) ? $admin_config['is_ajax'] : TRUE;
        $config['title'] = isset($admin_config['title']) ? $admin_config['title'] : str_ireplace('_', ' ', ucfirst($this->uri->segment(2)));
        /*         * list column */
        $config['list_columns'] = is_string(@$admin_config['list_columns']) ? explode(',', $admin_config['list_columns']) : NULL;
        /*         * dropdown */
        $config['use_dropdown_columns'] = is_string(@$admin_config['use_dropdown_columns']) ? explode(',', $admin_config['use_dropdown_columns']) : NULL;
        $config['use_dropdown_columns_options'] = isset($admin_config['use_dropdown_columns_options']) ? $admin_config['use_dropdown_columns_options'] : array();
        /*         * allowed action */
        $config['allowed_action'] = is_string(@$admin_config['allowed_action']) ? explode(',', $admin_config['allowed_action']) : $this->allowed_action;
        /*         * enable ordering */
        $config['enable_ordering'] = isset($admin_config['enable_ordering']) ? $admin_config['enable_ordering'] : FALSE;
        /*         * image */
        if (!isset($admin_config['use_image_columns_path'])) {
            $admin_config['use_image_columns_path'] = base_url() . 'uploads/' . NODE . '/';
        }
        $config['use_image_columns'] = is_string(@$admin_config['use_image_columns']) ? explode(',', $admin_config['use_image_columns']) : NULL;
        $config['use_image_columns_path'] = is_string(@$admin_config['use_image_columns_path']) ? explode(',', $admin_config['use_image_columns_path']) : $admin_config['use_image_columns_path'];

        if (!isset($admin_config['use_file_columns_path'])) {
            $admin_config['use_file_columns_path'] = base_url() . 'uploads/' . NODE . '/';
        }

        $config['use_file_columns'] = is_string(@$admin_config['use_file_columns']) ? explode(',', $admin_config['use_file_columns']) : NULL;
        
        $config['use_file_columns_path'] = is_string(@$admin_config['use_file_columns_path']) ? explode(',', $admin_config['use_file_columns_path']) : $admin_config['use_file_columns_path'];


        $tabledata['table_meta']['config'] = $config;
        $tabledata['table_meta']['data'] = isset($data['current_paged_list']) ? $data['current_paged_list'] : array();
        $tabledata['orderByModelData'] = $this->targetModel;
        return $this->render($tabledata, $view_template, true, false, false);
    }

    /**
     * generate view for index search section 
     */
    protected function generate_table_search_view($admin_config = array(), $view_template = 'elements/search_box_tpl')
    {
        /** auto field type detect Start* */
        $config = $this->auto_fieldtype_detect($admin_config);
        /** auto field type detect End* */
        /*         * dropdown */
        $config['use_dropdown_columns'] = is_string(@$admin_config['use_dropdown_columns']) ? explode(',', $admin_config['use_dropdown_columns']) : NULL;
        $config['use_dropdown_columns_options'] = isset($admin_config['use_dropdown_columns_options']) ? $admin_config['use_dropdown_columns_options'] : array();

        //$default['searchFields'] = is_string($admin_config['searchFields'])?$admin_config['searchFields']:NULL;
        $config['searchFields'] = is_string(isset($admin_config['searchFields']) ? $admin_config['searchFields'] : 0) ? explode(',', $admin_config['searchFields']) : NULL;
        $config['default_search_value'] = isset($admin_config['default_search_value']) ? $admin_config['default_search_value'] : NULL;

        return $this->render($config, $view_template, true, false, false);
    }

    /**
     * generate view for view details 
     */
    protected function generate_detail_view($data = NULL, $admin_config = array(), $view_template = 'elements/detail_tpl')
    {
        /** auto field type detect Start* */
        $config = $this->auto_fieldtype_detect($admin_config);
        /** auto field type detect End* */
        /** dropdown */
        $config['use_dropdown_columns'] = is_string(@$admin_config['use_dropdown_columns']) ? explode(',', $admin_config['use_dropdown_columns']) : NULL;
        $config['use_dropdown_columns_options'] = isset($admin_config['use_dropdown_columns_options']) ? $admin_config['use_dropdown_columns_options'] : array();

        /** image */
        if (!isset($admin_config['use_image_columns_path'])) {
            $admin_config['use_image_columns_path'] = base_url() . 'uploads/' . NODE . '/';
        }
        $config['use_image_columns'] = is_string(@$admin_config['use_image_columns']) ? explode(',', $admin_config['use_image_columns']) : NULL;
        $config['use_image_columns_path'] = is_string(@$admin_config['use_image_columns_path']) ? explode(',', $admin_config['use_image_columns_path']) : $admin_config['use_image_columns_path'];

        if (!isset($admin_config['use_file_columns_path'])) {
            $admin_config['use_file_columns_path'] = base_url() . 'uploads/' . NODE . '/';
        }
        $config['use_file_columns'] = is_string(@$admin_config['use_file_columns']) ? explode(',', $admin_config['use_file_columns']) : NULL;
        $config['use_file_columns_path'] = is_string(@$admin_config['use_file_columns_path']) ? explode(',', $admin_config['use_file_columns_path']) : $admin_config['use_file_columns_path'];



        $tabledata['table_meta']['config'] = $config;
        $tabledata['table_meta']['data'] = isset($data) ? $data : NULL;


        return $this->render($tabledata, $view_template, true, false, false);
    }

    /**
     * generate view for add or edit  details 
     */
    protected function generate_form_view($data = NULL, $admin_config = array(), $view_template = 'elements/add_edit_tpl')
    {
        /** auto field type detect Start* */
        $config = $this->auto_fieldtype_detect($admin_config);
        /** auto field type detect End* */
        /*         * validation */

        $config['validation'] = is_array(@$admin_config['validation']) ? $admin_config['validation'] : array();

        /** image */
        if (!isset($admin_config['use_image_columns_path'])) {
            $admin_config['use_image_columns_path'] = base_url() . 'uploads/' . NODE . '/';
        }
        $config['use_image_columns'] = is_string(@$admin_config['use_image_columns']) ? explode(',', $admin_config['use_image_columns']) : NULL;
        $config['use_image_columns_path'] = is_string(@$admin_config['use_image_columns_path']) ? explode(',', $admin_config['use_image_columns_path']) : $admin_config['use_image_columns_path'];

        if (!isset($admin_config['use_file_columns_path'])) {
            $admin_config['use_file_columns_path'] = base_url() . 'uploads/' . NODE . '/';
        }
        $config['use_file_columns'] = is_string(@$admin_config['use_file_columns']) ? explode(',', $admin_config['use_file_columns']) : NULL;
        $config['use_file_columns_path'] = is_string(@$admin_config['use_file_columns_path']) ? explode(',', $admin_config['use_file_columns_path']) : $admin_config['use_file_columns_path'];

        
        /** dropdown */
        $config['use_dropdown_columns'] = is_string(@$admin_config['use_dropdown_columns']) ? explode(',', $admin_config['use_dropdown_columns']) : NULL;
        $config['use_dropdown_columns_options'] = isset($admin_config['use_dropdown_columns_options']) ? $admin_config['use_dropdown_columns_options'] : array();


        /** imageuploader */
        $config['multi_upload'] = isset($admin_config['multi_upload']) ? ($admin_config['multi_upload'] ? 'true' : 'false') : 'false';

        /** readonly */
        $config['readonly_columns'] = is_string(@$admin_config['readonly_columns']) ? explode(',', $admin_config['readonly_columns']) : NULL;


        $tabledata['table_meta']['config'] = $config;
        $tabledata['table_meta']['data'] = isset($data) ? $data : NULL;

        return $this->render($tabledata, $view_template, true, false, false);
    }

    /**
     * Detect entry field type from database column type
     */
    protected function auto_fieldtype_detect($admin_config = NULL)
    {
        if (file_exists(ROOTPATH . 'fastapp/cachefiles/' . NODE . '/field' . $this->targetModel . '.txt')) {
            $config = json_decode(file_get_contents(ROOTPATH . 'fastapp/cachefiles/' . NODE . '/field' . $this->targetModel . '.txt'), true);
        } else {
            $tableFieldMeta = $this->{$this->targetModel}->get_field_list();
            $autoTextArea = NULL;
            $autoDatePicker = NULL;
            $autoDateTimePicker = NULL;
            $autoStatus = NULL;
            $primaryKey = NULL;
            foreach ($tableFieldMeta[0] as $key => $value) {
                if ($value['Type'] == 'text' || $value['Type'] == 'longtext') {
                    $autoTextArea[] = $key;
                }
                if ($value['Type'] == 'date') {
                    $autoDatePicker[] = $key;
                }
                if ($value['Type'] == 'datetime') {
                    $autoDateTimePicker[] = $key;
                }
                if ($value['Type'] == 'tinyint(1)') {
                    $autoStatus[] = $key;
                }
                if ($value['Key'] == 'PRI') {
                    $primaryKey = $key;
                }
            }
            /*             * textarea */
            $config['textarea_columns'] = is_string(@$admin_config['textarea_columns']) ? explode(',', $admin_config['textarea_columns']) : $autoTextArea;
            /*             * datetimepicker */
            $config['datetimepicker_columns'] = is_string(@$admin_config['datetimepicker_columns']) ? explode(',', $admin_config['datetimepicker_columns']) : $autoDateTimePicker;
            /*             * datepicker */
            $config['datepicker_columns'] = is_string(@$admin_config['datepicker_columns']) ? explode(',', $admin_config['datepicker_columns']) : $autoDatePicker;
            /*             * status */
            $config['use_status_columns'] = is_string(@$admin_config['use_status_columns']) ? explode(',', $admin_config['use_status_columns']) : $autoStatus;
            /*             * PRIMARY KEY */
            $config['tablePrimaryKey'] = is_string(@$admin_config['tablePrimaryKey']) ? $admin_config['tablePrimaryKey'] : $primaryKey;
            /** auto field type detect End* */
            file_put_contents(ROOTPATH . 'fastapp/cachefiles/' . NODE . '/field' . $this->targetModel . '.txt', json_encode($config));
        }
        return $config;
    }

    protected function menu_generater($reset = false)
    {
        if ($reset == true) {
            unlink(ROOTPATH . 'fastapp/cachefiles/' . NODE . '/menu_cache.txt');
        }
        $result_array = null;
        if (file_exists(ROOTPATH . 'fastapp/cachefiles/' . NODE . '/menu_cache0.txt')) {
            $result_array = json_decode(file_get_contents(ROOTPATH . 'fastapp/cachefiles/' . NODE . '/menu_cache.txt'), true);
            return $result_array;
        } else {
            $condition = NULL;
            if (isset($this->current_admin_session['admin_ID']))
                $condition = array('menu_admin_type_id' => $this->current_admin_session['admin_type_id']);

            $menu = $this->menus_model->get_list_for_dropdown(null, $condition);
            $processedMenu = array();

            foreach ($menu as $key => $value) {
                $processedMenu[$key] = $value;
                $subMenu = $this->menus_model->get_list_for_dropdown(null, array('menu_parent_id' => $value['menu_ID'], 'menu_admin_type_id' => $this->current_admin_session['admin_type_id']));

                foreach ($subMenu as $key => $value) {
                    $processedMenu[$key] = $value;
                }
            }
            $moduleMenu = NULL;
            $moduleMenuList = array();
            $modulemeta = explode(",", PLAN_PACKAGES);
            foreach ($modulemeta as $key => $value) {
                $moduleMeta[$key]['module_name'] = $value;
            }

            if ($moduleMeta) {
                foreach ($moduleMeta as $moduleData) {
                    $moduleMenu = json_decode(read_file(ROOTPATH . 'modules/' . $moduleData['module_name'] . '/config.json'), TRUE);
                    if (isset($moduleMenu['menu']) && is_array($moduleMenu['menu'])) {
                        foreach ($moduleMenu['menu'] as $value) {

                            if($this->current_admin_session['admin_type_id']==$value['menu_user_type_id'])
                            $moduleMenuList[$value['menu_ID']] = $value;
                            
                        }
                    }
                }
            }

            file_put_contents(ROOTPATH . 'fastapp/cachefiles/' . NODE . '/menu_cache.txt', json_encode($moduleMenuList + $processedMenu));

            // pr($moduleMenuList + $processedMenu);
            return $moduleMenuList + $processedMenu;
        }
    }

    /*
     * generic CRUD function in basic format
     *
     * * */

    /**
     * add detail
     */
    public function add_detail()
    {
        $postedData = $this->input->post();
        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        if (isset($postedData['load_add_entry'])) {
            $entryData = $this->{$this->targetModel}->get_field_list();
            echo $this->generate_form_view($entryData[0], $this->page_config);
        } else {
            if ($postedData) {
                /** status* */
                $config = $this->auto_fieldtype_detect(NULL);
                if (isset($config['use_status_columns'])) {
                    foreach ($config['use_status_columns'] as $statusColumn) {
                        $postedData[$statusColumn] = isset($postedData[$statusColumn]) ? 1 : 0;
                    }
                }
                /*                 * multi chooser */
                if (isset($this->page_config['use_dropdown_columns_options']['multi'])) {
                    foreach ($this->page_config['use_dropdown_columns_options']['multi'] as $multiChooser => $multi) {
                        if (isset($postedData[$multiChooser]))
                            $postedData[$multiChooser] = is_array($postedData[$multiChooser]) ? json_encode($postedData[$multiChooser]) : json_encode(array());
                        else
                            $postedData[$multiChooser] = '["0"]';
                    }
                }
                $lastInsertedID = $this->{$this->targetModel}->insert_data($postedData);

                echo (json_encode(array('status' => 'success', 'message' => 'Data Added Successfully')));
            }
        }
    }

    /**
     * edit detail
     */
    public function edit_detail()
    {
        $postedData = $this->input->post();
        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        if (isset($postedData['load_edit_entry'])) {
            $entryData2 = $this->{$this->targetModel}->get_list(array($this->{$this->targetModel}->get_primary_key() => trim($postedData['load_edit_entry'])));
            $entryData1 = $this->{$this->targetModel}->get_field_list();
            $entryData = array_intersect_key($entryData2[0], $entryData1[0]);
            echo $this->generate_form_view($entryData, $this->page_config);
        } else {
            if ($postedData) {
                /** status* */
                if (isset($config['use_status_columns'])) {
                    foreach ($config['use_status_columns'] as $statusColumn) {
                        $postedData[$statusColumn] = isset($postedData[$statusColumn]) ? 1 : 0;
                    }
                }
                /*                 * multi chooser */
                if (isset($this->page_config['use_dropdown_columns_options']['multi'])) {
                    foreach ($this->page_config['use_dropdown_columns_options']['multi'] as $multiChooser => $multi) {
                        $postedData[$multiChooser] = @is_array($postedData[$multiChooser]) ? json_encode($postedData[$multiChooser]) : json_encode(array());
                    }
                }

                $this->{$this->targetModel}->update_data($postedData, array($config['tablePrimaryKey'] => $postedData[$config['tablePrimaryKey']]));
                echo (json_encode(array('status' => 'success', 'message' => 'Data Updated Successfully')));
            }
        }
    }

    /**
     * view detail
     */
    public function view_detail()
    {
        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        $entryID = trim($this->input->post('entry'));
        $entryData2 = $this->{$this->targetModel}->get_list(array($this->page_config['tablePrimaryKey'] => $entryID));
        $entryData1 = $this->{$this->targetModel}->get_field_list();
        $entryData = array_intersect_key($entryData2[0], $entryData1[0]);
        echo $this->generate_detail_view($entryData, $this->page_config);
    }

    public function autocomplete()
    {
        $field = $this->uri->segment(5);
        $model = $this->uri->segment(4);
        $search = $this->input->get('term');
        $data = ($this->{$model}->get_list_for_dropdown(null, NULL, NULL, 10, NULL, array($field => $search)));
        $responce = null;
        foreach ($data as $id => $value) {
            $responce[] = array('id' => $id, 'label' => $value[$field], 'value' => $value[$field], 'complete' => $value);
        }
        echo json_encode($responce);
    }

    /**
     * delete
     */
    public function delete()
    {
        $postedData = $this->input->post();
        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        if (isset($postedData['selectedItem'])) {
            $this->{$this->targetModel}->delete(array($this->page_config['tablePrimaryKey'] => $postedData['selectedItem']), TRUE);
        }

        if (isset($postedData['entry'])) {
            $this->{$this->targetModel}->delete(array($this->page_config['tablePrimaryKey'] => $postedData['entry']));
        }
        echo json_encode(array('status' => 'success'));
    }

    /**
     * index show list
     */
    public function index()
    {

        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        $orderBy = $this->orderby_input_process();
        $likeCondition = $this->generate_search_like_condition();
        $allData = $this->{$this->targetModel}->get_list_for_tables(NULL, FALSE, $this->current_site_settings['site_setting_record_per_page'], NULL, $likeCondition, $orderBy);
        $data['generateTableView'] = $this->generate_table_view($allData, $this->page_config);
        if ($this->input->post()) {
            echo $data['generateTableView'];
        } else {
            $data['generateTableSearch'] = $this->generate_table_search_view($this->page_config);
            $this->render($data);
        }
    }

    /*     * some of helper function* */

    protected function orderby_input_process()
    {
        $orderBy = '';
        if (isset($_COOKIE['orderBy_' . $this->targetModel])) {
            $orderByArr = explode(':', $_COOKIE['orderBy_' . $this->targetModel]);
            $orderBy = $orderByArr[0] . ' ' . $orderByArr[1];
        }
        return $orderBy;
    }

    protected function generate_search_like_condition()
    {
        $config = $this->auto_fieldtype_detect(NULL);
        //$this->page_config['default_search_value']['invoice_period'] = date('F-y');
        $posted = $this->input->post();
        if (empty($posted)) {
            $posted = isset($this->page_config['default_search_value']) ? $this->page_config['default_search_value'] : NULL;
        }
        $likeCondition = NULL;

        if (isset($config['use_status_columns'])) {
            foreach ($config['use_status_columns'] as $statusColumn) {
                $posted[$statusColumn] = isset($posted[$statusColumn]) ? 1 : 0;
            }
        }

        $searchFields = explode(',', $this->page_config['searchFields']);

        foreach ($searchFields as $searchField) {

            $likeCondition[$searchField] = isset($posted[str_replace('.', '_', $searchField)]) ? $posted[str_replace('.', '_', $searchField)] : NULL;
        }
        return $likeCondition;
    }

    public function chooseUpload()
    {
        $mimeTypes = explode(',', $this->input->post('mimeTypes'));
        $dirMap = directory_map('./uploads/' . NODE);
        $dataArray = [];
        foreach ($dirMap as  $value) {
            $currentFile = explode('.', $value);
            if (array_search($currentFile[1], $mimeTypes) !== FALSE) {
                $dataArray[] = $value;
            }
        }
        echo json_encode($dataArray);
    }

    /*
     * not translated
     * * */

    private function show_error_page($code = null, $message = null)
    {
        if ($this->uri->segment(1) == 'console') {
            $message = '<script>window.location="' . base_url('console_login') . '"</script>Please Wait...';
            show_error($message, $code, 'Oops!! Please wait...');
        } else {
            $message = $code . ': Content is not available..please wait, while we are redirecting.<script>window.location="' . base_url() . '"</script>';
            show_error($message, $code, 'Oops!! Please wait...');
        }
    }

    public function quick_edit()
    {
        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        $postedData = $this->input->post();
        $field = explode('-', $postedData['targetItem']);
        $dataToSave = null;
        $dataToSave[$this->page_config['tablePrimaryKey']] = intval($field[1]);
        $dataToSave[$field[0]] = $postedData['targetValue'];
        $this->{$this->targetModel}->update_data($dataToSave, array($this->page_config['tablePrimaryKey'] => $dataToSave[$this->page_config['tablePrimaryKey']]));
        echo (json_encode(array('status' => 'success', 'message' => 'Data Updated Successfully')));
    }

    protected function set_admin_session($admin_ID)
    {
        $adminData = $this->admins_model->get_list(array('admin_ID' => $admin_ID));
        $this->session->set_userdata('current_admin_session', $adminData[0]);
    }
}
