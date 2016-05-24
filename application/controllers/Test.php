<?php
/**
 * Created by PhpStorm.
 * User: meijiang
 * Date: 2016/4/27
 * Time: 14:14
 */
class Test extends CI_Controller{
    public function index()
    {
//        $this->load->library('session');
//        $this->session->set_userdata(array('id'=>1));
//        echo $this->session->userdata('id');
//        $this->load->driver('cache');
//        $this->cache->memcached->save('abc','love');
//        $memcache = $this->cache->memcached->get('abc');

//        $this->_memcache = new Memcached();
//        $this->_memcache->connect();
//
//        var_dump($memcache);
//        $this->load->helper('Memcache_helper');
//        $mc = $this->Memcache_helper->start_memcached();
//        $mc->set('mei','1111');
//        $value = $mc->get('mei');
//        echo $value;

//        $this->load->library('MY_memcache');
//        $mc = $this->MY_Memcache->start_memcached();
//        $mc->set('mei','1111');
//        $value = $mc->get('mei');
//        echo $value;

        $this->load->library('Mem');
        $str = $this->mem->start_memcached();
        //$str->set('mei','hello',MEMCACHE_COMPRESSED,30);
        $v = $str->get('mei');
        echo $v;exit;

    }
}