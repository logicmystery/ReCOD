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
class Menu extends MY_Controller
{

    //put your code here

    public function __construct()
    {
        parent::__construct();

        //    $this->page_config['use_status_columns'] = 'menu_status';
        $this->targetModel = 'menus_model';
        //  $this->page_config['use_image_columns'] = 'site_setting_logo';
        //$this->page_config['use_image_columns_path'] = base_url().'uploads/';
        $this->page_config['use_dropdown_columns'] = 'menu_parent_id,menu_admin_type_id';
        $menuList = $this->menus_model->get_list_for_dropdown(null, array('menu_parent_id' => 0));
        $menuDropdown = null;
        foreach ($menuList as $key => $value) {
            $menuDropdown[$key] = $value['menu_name'];
        }
        $this->page_config['use_dropdown_columns_options']['menu_parent_id'] = $menuDropdown;
        $this->page_config['use_dropdown_columns_options']['menu_admin_type_id'] = $this->admin_types_model->get_list_for_dropdown('admin_type_name');
        $this->page_config['tablePrimaryKey'] = $this->menus_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Menu'; //search title bar
        $this->page_config['searchFields'] = 'menu_parent_id,menu_admin_type_id'; //search box,
        $this->page_config['list_columns'] = 'menu_name,menu_parent_id,menu_icon_class,menu_admin_type_id';
        //$this->page_config['readonly_columns'] = 'menu_registered';
        //$this->page_config['textarea_columns'] = 'menu_description';
        $this->menu_generater(true);
        /*         * end page_config* */
    }

    //---------------------------------------------------------------
    /**
     * non generic functions
     * * */
}
