<?php
/**
 * Created by PhpStorm.
 * User: wangliang
 * Date: 16/5/1
 * Time: 下午2:31
 */

class Shops_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 获取一个月的收入
     *
     * @param array $param
     * @return object
     */
    public function get_income($param)
    {
        $url = $this->api_url . "api/shops/income";
        $res = $this->getCurl($url, $param);

        return $res;
    }

    /**
     * 获取店铺基本信息
     */
    public function get_info()
    {
        $url = $this->api_url . "api/shops/info";
        $res = $this->getCurl($url);

        return $res;
    }
}