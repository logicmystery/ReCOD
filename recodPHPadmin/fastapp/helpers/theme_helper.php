<?php

/* * *************************************some theme function******************************** */

/**
 * used for get theme data value
 * 
 * * */
function site_header($param = 'header_tpl') {
    $CI = &get_instance();
    include ROOTPATH . 'themes/' . $CI->current_site_settings['site_setting_theme'] . '/' . $param . '.php';
}

function site_footer($param = 'footer_tpl') {
    $CI = &get_instance();
    require_once ROOTPATH . 'themes/' . $CI->current_site_settings['site_setting_theme'] . '/' . $param . '.php';
}

function site_title() {
    $CI = &get_instance();
    return $CI->current_site_settings ['site_setting_title'];
}
function site_keyword() {
    $CI = &get_instance();
    return $CI->current_site_settings['site_setting_description'];
}
function site_meta_description() {
    $CI = &get_instance();
    return $CI->current_site_settings['site_setting_description'];
}
function site_theme() {
    $CI = &get_instance();
    return $CI->current_site_settings['site_setting_theme'];
}
function site_logo() {
    $CI = &get_instance();
    return (empty($CI->current_site_settings['site_setting_logo']) ? 'noImage.jpg' : CLOUD_NODE . '/' . $CI->current_site_settings['site_setting_logo']);
}

function frontend_menu() {
    $CI = &get_instance();
    $menus = $CI->site_menus_model->get_list(NULL, NULL, NULL, NULL, NULL, 'site_menu_order ASC');
    $dataArry = NULL;
    foreach ($menus as $key => $value) {
        $dataArry[$value['site_menu_type']][] = $value;
    }
    return $dataArry;
}

function theme_data($param) {
    return get_option($param);
}

function page_meta($param = NULL) {
    $page_meta_data = page_data('page_meta');
    if ($param)
        return $page_meta_data[$param];
    else
        return $page_meta_data;
}

function current_page() {
    $CI = &get_instance();
    return $CI->uri->segment(1);
}

/**
 * generate navigation menu
 * * */
function site_menu($menuType = 'primary') {
    $CI = &get_instance();
    $menus = $CI->site_menus_model->get_list(array('site_menu_type' => $menuType), NULL, NULL, NULL, NULL, 'site_menu_order ASC');
    return $menus;
}

/**
  get theme meta data
 *  */
function get_theme_meta($targetTheme) {
    $themeMeta = read_file(ROOTPATH . "themes/" . $targetTheme . '/theme.json');
    return json_decode($themeMeta, TRUE);
}

/* * get page data */

function page_data($section = NULL) {
    $CI = &get_instance();
    $uri = $CI->uri->segment(1);
    $page = $CI->pages_model->get_list(array('page_uri' => "$uri", 'page_status' => 1));
    $page_meta = json_decode($page[0]['page_meta'], TRUE);

    $themeMeta = get_theme_meta($CI->current_site_settings['site_setting_theme']);
    foreach ($themeMeta['dynamic_text'][$page[0]['page_template']] as $metaKey => $metaValue) {
        if (isset($page_meta[$metaKey])) {
            if ($page_meta[$metaKey] == "")
                $page_meta[$metaKey] = $metaValue;
        } else {
            $page_meta[$metaKey] = $metaValue;
        }
    }
    $page[0]['page_meta'] = $page_meta;
    if ($section) {
        return $page[0][$section];
    } else {
        return $page[0];
    }
}

/* * *************************************some theme function******************************** */

/* * ********** authentication related******* */

function is_loggedin() {
    $CI = &get_instance();
    return empty($CI->current_user_session) ? 0 : 1;
}

function loggedin_user($param = null) {
    $CI = &get_instance();
    if (!empty($CI->current_user_session)) {
        if ($param == NULL) {
            return $CI->current_user_session;
        } else {
            return $CI->current_user_session[$param];
        }
    } else
        return false;
}

/************ authentication related********/
/**swapnasish*/

/**swapnasish*/