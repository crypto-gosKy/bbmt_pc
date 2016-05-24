<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/5
 * Time: 12:11
 */
class Acl {
    private $url_model;
    private $url_method;
    private $CI;

    public function __construct()
    {
        session_start();

        $this->CI =& get_instance();
        $this->url_model = $this->CI->uri->segment(1);
        $this->url_method = $this->CI->uri->segment(2);
    }

    public function auth()
    {
        $mem = new Memcache;
        $mem->connect(config_item('memcache_ip'), config_item('memcache_port'));
        $sess = $mem->get(session_id());

        if(!$sess && strtolower($this->url_model) != 'login') {
            redirect(site_url('login'));
        }
    }
}