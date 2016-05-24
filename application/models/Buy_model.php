<?php
/**
 * Created by PhpStorm.
 * User: meijiang
 * Date: 2016/5/3
 * Time: 10:29
 */
class Buy_model extends MY_Model{
    /**
     * 获取下单数据
     * @param $params
     * @return array|mixed
     */
    public function get_order_item($params){
        $url = $this->api_url.'api/order/item';
        $res = $this->getCurl($url,$params);
        if(!$this->is_show_price()){
            $res['data']['pay_amount'] = '--';
            $res['data']['_pay_amount'] = '--';
            $res['data']['orders']['price'] = '--';
            $res['data']['orders']['_price'] = '--';
            $res['data']['orders']['total_fee'] = '--';
            $res['data']['orders']['_total_fee'] = '--';
        }
        return $res;
    }

    /**
     * 提交订单
     * @param $params
     * @return array|mixed
     */
    public function post_order($params){
        $url = $this->api_url.'api/order/submit';
        return $this->postCurl($url,$params);
    }

    /**
     * 取消订单
     * @param $params
     * @return array|mixed
     */
    public function cancel_order($params){
        $url = $this->api_url.'api/trade/cancel';
        return $this->postCurl($url,$params);
    }
}