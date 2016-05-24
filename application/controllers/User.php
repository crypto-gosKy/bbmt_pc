<?php
/**
 * Created by PhpStorm.
 * User: meijiang
 * Date: 2016/5/3
 * Time: 9:56
 */
class User extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_user_address(){
        $data['mobile'] = $this->input->get_post('mobile');
        if(!$data['mobile']){
            echo json_encode(array('status'=>false,'msg'=>'缺少手机号码'));
        }
        $res = $this->get_model('User_model','get_user_address',$data);
        if($res['return_code']){
            $return = array('status'=>false,'msg'=>$res['return_msg']);
        }else{
            $return = array('status'=>true,'data'=>$res['data']);
        }
        echo json_encode($return);
        exit;
    }

    /**
     * 设置价格显示
     */
    public function setprice() {
        $data = $this->get_model('Users_model', 'set_show_price');

        //更新用户状态
        $this->load->driver('cache');
        $user_state = json_decode($this->cache->memcached->get(session_id() . '_state'), true);
        $user_state['data']['show_price'] = intval($data['data']['show_price']);
        $this->cache->memcached->save(session_id() . '_state', json_encode($user_state), 7200);

        echo json_encode($data);
    }

    /**
     * 修改密码
     */
    public function changepwd() {
        $param                = array();
        $param['oldpassword'] = $this->input->post('oldpassword');
        $param['password']    = $this->input->post('password');
        $param['password2']   = $this->input->post('password2');

        $return = $this->get_model('Users_model', 'do_changepwd', $param);

        echo json_encode($return);
    }

    public function logout() {
        $return = $this->get_model('Users_model', 'do_logout');

        echo json_encode($return);
    }
}