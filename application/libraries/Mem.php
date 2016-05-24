<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: meijiang
 * Date: 2016/4/28
 * Time: 20:37
 */
class Mem {
    protected $hostname;
    protected $port;
    protected $_memcached;
    private $_ci;
    private  $mem;
    public function __construct()
    {
        $this->_ci = & get_instance();
        $this->hostname = $this->_ci->config->item('memcache_ip');
        $this->port = $this->_ci->config->item('memcache_port') ? $this->_ci->config->item('memcache_port') : 11211;
        $this->mem = $this->start_memcached();

    }

    /**
     * 设置缓存
     * @param $key 存储键
     * @param $value 存储的数据
     * @param int $flag 压缩方式
     * @param $expire_time 过期时间
     */
    public function save($key,$value,$flag=MEMCACHE_COMPRESSED,$expire_time){
        $this->mem->set($key,$value,$flag,$expire_time);
    }

    /**
     * 获取存储的值
     * @param $key
     * @return array|mixed|string
     */
    public function get($key){
        return $this->mem->get($key);
    }

    /**
     * 启动memcached
     * @return Memcache|Memcached
     */
    protected function start_memcached(){
        if(extension_loaded('memcache')){
            $this->_memcached = new Memcache();
        }else if(extension_loaded('memcached')){
            $this->_memcached = new Memcached();
        }
        //连接方式则
        if(extension_loaded('memcached')){
            $this->_memcached->addServer($this->hostname, $this->port);
        }elseif(extension_loaded('memcache')){
            $this->_memcached->connect($this->hostname, $this->port);
        }
        return $this->_memcached;
    }

}