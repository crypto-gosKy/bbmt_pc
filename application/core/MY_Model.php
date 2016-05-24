<?php
/**
 * Created by PhpStorm.
 * User: meijiang
 * Date: 2016/4/27
 * Time: 15:23
 */
class MY_Model extends CI_Model{
    protected $api_url;
    protected $cookie_file;
    public function __construct()
    {
        parent::__construct();
        $this->api_url = $this->config->item('api_url');
    }

    //curl请求数据
    public function postCurl($url,$data=array()){
        $ch        = curl_init($url);
        $strCookie = "PHPSESSID=" . session_id();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_COOKIE, $strCookie);
        $response = curl_exec($ch);
        curl_close($ch);

        if($response) {
            $response = json_decode($response,true);
            return $response;
        } else {
            log_message('INFO', $response);
            return array('return_code'=>101,'return_msg'=>'暂无数据');
        }
    }

    public function getCurl($url, $data = array()) {
        $ch        = curl_init($url . (!empty($data) ? '?' . http_build_query($data) : ''));
        $strCookie = "PHPSESSID=" . session_id();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIE, $strCookie);
        $response = curl_exec($ch);
        curl_close($ch);

        if($response) {
            $response = json_decode($response,true);
            return $response;
        } else {
            log_message('INFO', $response);
            return array('return_code'=>101,'return_msg'=>'暂无数据');
        }
    }

    /**
     * 给支付宝用
     * @param $url
     * @param array $data
     * @return array|mixed
     */
    public function formCurl($url,$data=array()){
        $ch        = curl_init($url);
        $strCookie = "PHPSESSID=" . session_id();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_COOKIE, $strCookie);
        $response = curl_exec($ch);
        curl_close($ch);

        if($response) {
            $response = json_decode($response); //不能全部decode
            return $response;
        } else {
            log_message('INFO', $response);
            return array('return_code'=>101,'return_msg'=>'暂无数据');
        }
    }

    /**
     * 是否显示价格
     * @return bool
     */
    protected function is_show_price(){
        $is_show = true;               //默认显示价格
        $this->load->model('Users_model');
        $user_info = $this->Users_model->get_user_state();
        if($user_info && !$user_info['data']['show_price']){    //如果设置了不显示价格
            $is_show = false;
        }
        return $is_show;
    }

}