<?php

/*
 * some useful helping functions
 * * */

function display_multi_option($choosen, $allList) {
    $output = '';
    foreach ($choosen as $key => $value) {

        if ($key > 0) {
            $output.=', ';
        }
        $output.= isset($allList[$value]) ? $allList[$value] : 'N/A';
    }
    return $output;
}

/* * for forms inputs* */

function is_readonly($t_key, $readonly_columns = NULL) {

    if (is_array($readonly_columns)) {
        $arr_index = array_search($t_key, $readonly_columns);
        if ($arr_index !== FALSE)
            return TRUE;
        else
            return FALSE;
    }
}

function module_header_footer_hook() {
    $user_function = get_defined_functions();
    $functions = null;
    foreach ($user_function['user'] as $function) {
        $function_explode = explode('_', $function);
        // pr($function);
        if ($function_explode[0] == 'header') {
            $functions['header'][] = $function;
        }
        if ($function_explode[0] == 'footer') {
            $functions['footer'][] = $function;
        }
    }
    return $functions;
}
