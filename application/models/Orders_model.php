<?php
/**
 * Created by PhpStorm.
 * User: wangliang
 * Date: 16/4/28
 * Time: 下午3:40
 */

class Orders_model extends MY_Model {

    /**
     * 获取订单列表
     *
     * @param array $param
     * @return object
     */
    public function get_orders($param = array()) {
        $url = $this->api_url . "api/trade/trade_list";
        $res = $this->getCurl($url, $param);
        if(!$this->is_show_price() && $res['return_code'] == 0){
            foreach($res['data']['trade_list'] as $key => &$val){
                $val['pay_amount'] = '--';
                foreach($val['orders'] as $k =>&$order){
                    $order['price'] = '--';
                    $order['total_fee'] = '--';
                }
            }
        }
        return $res;
    }

    /**
     * 获取订单详情
     *
     * @param array $param
     * @return object
     */
    public function get_detail($param = array()) {
        $url = $this->api_url . "api/trade/detail";
        $res = $this->getCurl($url, $param);
        if(!$this->is_show_price() && $res['return_code'] == 0){
            $res['data']['total_fee'] = '--';
            $res['data']['pay_amount'] = '--';
            foreach($res['data']['orders'] as $key => &$order){
                $order['price'] = '--';
                $order['total_fee'] = '--';
            }
        }
        return $res;
    }

    /**
     * 获取订单详情
     * 给支付页面使用
     * @param array $param
     * @return object
     */
    public function get_detail_topay($param = array()) {
        $url = $this->api_url . "api/trade/detail";
        $res = $this->getCurl($url, $param);

        return $res;
    }

    /*
     * 导出订单
     */
    public function export() {
        $ch        = curl_init($this->api_url . 'api/trade/trade_xls?flag=xls');
        $strCookie = "PHPSESSID=" . $_COOKIE['PHPSESSID'];

        curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_COOKIE, $strCookie);
        $response = curl_exec($ch);
        curl_close($ch);

        $filename = md5(time()) . '.xls';

        $path = 'xls/' . $filename;

        $fp= @fopen($path, "w");
        fwrite($fp,$response);

        return array(
            'filename' => $filename,
            'path'     => $path
        );
    }


    /**
     * 取消订单
     *
     * @param array $param
     * @return array
     */
    public function do_cancel($param) {
        $url = $this->api_url . "/api/trade/cancel";

        $res = $this->postCurl($url, $param);

        return $res;
    }

    /**
     * 用户确认收货接口
     * @param $param
     * @return array|mixed
     */
    public function confirm_receive($param){
        $url = $this->api_url. '/api/trade/success';
        $res = $this->postCurl($url,$param);
        return $res;
    }
}