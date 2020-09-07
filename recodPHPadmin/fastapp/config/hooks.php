<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------------
  | Hooks
  | -------------------------------------------------------------------------
  | This file lets you define "hooks" to extend CI without hacking the core
  | files.  Please see the user guide for info:
  |
  |	http://codeigniter.com/user_guide/general/hooks.html
  |
 */




$hook['pre_system'][] = array(
    'class' => 'plugins',
    'function' => 'pre_system',
    'filename' => 'plugins.php',
    'filepath' => 'plugins',
    'params' => array('pre_system 1')
);

$hook['pre_controller'][] = array(
    'class' => 'plugins',
    'function' => 'pre_controller',
    'filename' => 'plugins.php',
    'filepath' => 'plugins',
    'params' => array('pre_controller 1')
);

$hook['post_controller_constructor'][] = array(
    'class' => 'plugins',
    'function' => 'post_controller_constructor',
    'filename' => 'plugins.php',
    'filepath' => 'plugins',
    'params' => array('post_controller_constructor 1 ')
);
$hook['post_controller_constructor'][] = array(
    'class' => 'plugins',
    'function' => 'post_controller_constructor',
    'filename' => 'plugins.php',
    'filepath' => 'plugins',
    'params' => array('post_controller_constructor 2')
);

$hook['post_controller'][] = array(
    'class' => 'plugins',
    'function' => 'post_controller',
    'filename' => 'plugins.php',
    'filepath' => 'plugins',
    'params' => array('post_controller')
);


$hook['display_override'][] = array(
    'class' => 'plugins',
    'function' => 'display_override',
    'filename' => 'plugins.php',
    'filepath' => 'plugins',
    'params' => array('display_override')
);
/*
/*
$hook['cache_override'][] = array(
    'class' => 'plugins',
    'function' => 'cache_override',
    'filename' => 'plugins.php',
    'filepath' => 'plugins',
    'params' => array('cache_override')
);
*/



/* End of file hooks.php */
/* Location: ./application/config/hooks.php */