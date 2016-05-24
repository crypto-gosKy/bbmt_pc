<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/5
 * Time: 16:49
 */

class Users_model extends MY_Model
{
    /**
     * 登录操作
     *
     * @param array $param
     * @return object
     */
    public function do_login($param)
    {
        $url = $this->api_url . "api/login";
        $res = $this->getCurl($url, $param);

        return $res;
    }

    /**
     * 获取用户地址
     * @param $params
     * @return array|mixed
     */
    public function get_user_address($params)
    {
        $url = $this->api_url.'api/user/address';

        return $this->postCurl($url,$params);
    }

    /**
     * 保存用户收货地址接口
     * @param $params
     * @return array|mixed
     */
    public function save_address($params){
        $url = $this->api_url.'/api/user/save_address';
        return $this->postCurl($url,$params);
    }

    /**
     * 删除用户收货地址
     * @param $params
     * @return array|mixed
     */
    public function delete_address($params){
        $url = $this->api_url.'/api/user/remove_address';
        return $this->postCurl($url,$params);
    }

    /**
     * 设置价格显示
     *
     * @return array
     */
    public function set_show_price() {
        $url = $this->api_url.'api/setprice';

        return $this->getCurl($url);
    }

    /**
     * 获取用户状态
     * @return array
     */
    public function get_user_state() {
        $root = array('data' => array());

        $this->load->driver('cache');

        $str_session = $this->cache->memcached->get(session_id());

        if($str_session) {
            $arr_session = explode(';', $str_session);

            foreach($arr_session as $item) {
                if(!empty($item)) {
                    $arr_item = explode('|', $item);
                    if($arr_item[0] == 'BMT_UID') {
                        $root['data']['user_id'] = unserialize($arr_item[1] . ';');
                    }

                    if($arr_item[0] == 'BMT_UNAME') {
                        $root['data']['username'] =  unserialize($arr_item[1] . ';');
                    }

                    if($arr_item[0] == 'BMT_SHOWPRICE') {
                        $root['data']['show_price'] =  unserialize($arr_item[1] . ';');
                    }

                    if($arr_item[0] == 'BMT_STORENAME') {
                        $root['data']['store_name'] =  unserialize($arr_item[1] . ';');
                    }

                    if($arr_item[0] == 'BMT_BDUSER') {
                        $root['data']['bd_user'] =  unserialize($arr_item[1] . ';');
                    }

                    if($arr_item[0] == 'BMT_BDMOBILE') {
                        $root['data']['bd_mobile'] =  unserialize($arr_item[1] . ';');
                    }
                }
            }

            return $root;
        }

        return false;
    }

    /**
     * 修改密码
     *
     * @param array $params
     * @return array
     */
    public function do_changepwd($params) {
        $url = $this->api_url.'api/changepwd';

        return $this->postCurl($url,$params);
    }

    /**
     * 退出登录
     */
    public function do_logout() {
        $url = $this->api_url.'api/logout';

        return $this->postCurl($url);
    }
}