<?php
/**
 * Created by PhpStorm.
 * User: wangliang
 * Date: 16/5/9
 * Time: 下午5:01
 */

defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('get_user'))
{
    function get_user() {
        $CI = &get_instance();

        $CI->load->model('Users_model');

        $user = $CI->Users_model->get_user_state();

        return $user;
    }
}

if( ! function_exists('get_c_m'))
{
    /**
     * 获取控制器和函数
     */
    function get_c_m() {
        $CI         = &get_instance();

        $controller = $CI->router->class;
        $method     = $CI->router->method;

        return array(
            'controller' => $controller,
            'method' => $method
        );
    }
}
