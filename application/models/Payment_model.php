<?php
/**
 * Created by PhpStorm.
 * User: meijiang
 * Date: 2016/4/29
 * Time: 17:34
 */
class Payment_model extends MY_Model{
    /**
     * 微信支付
     * @param $params
     * @return bool|mixed
     */
    public function wechat_pay($params){
        $url = $this->api_url.'api/pay/notify';
        return $this->postCurl($url,$params);
    }

    /**
     * 支付宝即时到账接口
     * @param $params
     * @return array|mixed
     */
    public function alipay($params){
        $url = $this->api_url.'api/AliPay';
        return $this->postCurl($url,$params);
    }
}