<?php
/**
 * Created by PhpStorm.
 * User: meijiang
 * Date: 2016/4/29
 * Time: 17:03
 */
class Logistics_model extends MY_Model{
    /**
     * 获取物流跟踪信息
     * @param $params
     * @return bool|mixed
     */
    public function get_logistics_info($params){
        $url = $this->api_url.'api/trade/trace_detail';
        return $this->getCurl($url,$params);
    }
}