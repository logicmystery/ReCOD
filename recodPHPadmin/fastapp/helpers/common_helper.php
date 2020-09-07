<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/* * ***********

 * **** */

function set_widget($widget_function = null, $type = null) {
    $system = &get_instance();
    if (!empty($widget_function) && !empty($type))
        $system->module->widget[$type][] = $widget_function;
}

function get_widget($type) {
    $widgetData = null;
    $system = &get_instance();
    if (!empty($type) && !empty($system->module->widget[$type]))
        foreach ($system->module->widget[$type] as $widget) {
            $widgetData[] = $widget();
        }
    return $widgetData;
}

function pr($param, $is_exit = FALSE) {
    echo '<pre>';
    print_r($param);
    echo '</pre>';
    if ($is_exit)
        exit();
}

function convert_number_to_words($number) {

    $hyphen = '-';
    $conjunction = ' and ';
    $separator = ', ';
    $negative = 'negative ';
    $decimal = ' point ';
    $dictionary = array(
        0 => 'zero',
        1 => 'one',
        2 => 'two',
        3 => 'three',
        4 => 'four',
        5 => 'five',
        6 => 'six',
        7 => 'seven',
        8 => 'eight',
        9 => 'nine',
        10 => 'ten',
        11 => 'eleven',
        12 => 'twelve',
        13 => 'thirteen',
        14 => 'fourteen',
        15 => 'fifteen',
        16 => 'sixteen',
        17 => 'seventeen',
        18 => 'eighteen',
        19 => 'nineteen',
        20 => 'twenty',
        30 => 'thirty',
        40 => 'fourty',
        50 => 'fifty',
        60 => 'sixty',
        70 => 'seventy',
        80 => 'eighty',
        90 => 'ninety',
        100 => 'hundred',
        1000 => 'thousand',
        1000000 => 'million',
        1000000000 => 'billion',
        1000000000000 => 'trillion',
        1000000000000000 => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens = ((int) ($number / 10)) * 10;
            $units = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}

function cdn_url($param = '') {
    return base_url() . $param;
}

function console_url($param = '') {
    return base_url() . 'console/' . $param;
}

function get_option($param) {
    $CI = &get_instance();
    return $CI->options_model->get_option($param);
}

function set_option($param, $data) {
    $CI = &get_instance();
    return $CI->options_model->set_option($param, $data);
}

function is_logged_in() {
    $CI = &get_instance();
    if (isset($CI->$current_user_session))
        return $CI->$current_user_session;
    else
        return FALSE;
}

// fetch all controller methods
// --------------------------------------------------------------------

/**
 * get_controller_methods()
 *
 * Description:
 *
 * @access public
 * @param       string
 * @return array
 */
function get_controller_methods($controller_name) {
    $ctrl_methods = array();

    $ctrl_methods = get_class_methods($controller_name);

    return $ctrl_methods;
}

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

function register_hook($function_name, $hook_name) {
    
    $CI = &get_instance();
    $CI->function_hook[$hook_name][] = $function_name;
    
}

function execute_hook($hook_name) {
    $CI = &get_instance();
    if (isset($CI->function_hook[$hook_name]))
        foreach ($CI->function_hook[$hook_name] as $function_name) {
            if (function_exists($function_name)) {
                $function_name();
            }
        }
}

function app_reply($message = "", $content = "", $eval = "", $setData = "") {
    echo json_encode(array(
        'message' => $message,
        'content' => $content,
        'eval' => $eval,
        'setData' => array("key" => key($setData), "value" => $setData[key($setData)]),
    ));
}
