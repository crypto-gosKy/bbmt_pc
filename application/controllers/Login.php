<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/5
 * Time: 15:27
 */

class Login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 加载登录界面
     */
    public function index() {
        $this->load->view('Login/login');
    }

    /**
     * 提交登录操作
     */
    public function dologin() {
        $param              = array();
        $username           = trim($this->input->post('username'));
        $password           = trim($this->input->post('password'));
        $param['username']  = $username;
        $param['password']  = $password;
        $data               = $this->get_model('Users_model', 'do_login', $param);

        //处理用户登录缓存
        if($data['return_code'] == 0) {
            $this->load->driver('cache');
            $this->cache->memcached->save(session_id() . '_state', json_encode($data), 7200);
        }

        if($this->input->is_ajax_request()) {
            echo json_encode($data);
        } else {
            $this->load->view('Login/login');
        }
    }
}