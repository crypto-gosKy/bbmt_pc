<?php
/**
 * Created by PhpStorm.
 * User: meijiang
 * Date: 2016/5/3
 * Time: 10:40
 */
class Buy extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 渲染下单页面
     */
    public function index(){
        $view_data['orderInfo'] = $this->get_order_item();
        $view_data['address'] = $this->get_user_address($view_data['orderInfo']['trade_type']);
        $this->load->view('Buy/index',$view_data);
    }

    /**
     * 请求下单数据接口
     */
    public function ajax_get_order_data(){
        $data['item_id'] = $this->input->get_post('item_id');
        $data['sku_id'] = $this->input->get_post('sku_id');
        $data['num'] = $this->input->get_post('num');
        $data['send_addrs'] = $this->input->get_post('send_addrs');
        if(!$data['item_id'] || !$data['sku_id']){
            echo json_encode(array('status'=>false,'msg'=>'缺少商品参数'));
            exit;
        }
        $res = $this->get_model('Buy_model','get_order_item',$data);
        if($res['return_code']){
            $return = array('status'=>false,'msg'=>$res['return_msg']);
        }else{
            $return = array('status'=>true,'data'=>$res['data']);
        }
        echo json_encode($return);
        exit;
    }

    /**
     * 获取下单数据
     */
    public function get_order_item(){
        $data['item_id'] = $this->input->get_post('item_id');
        $data['sku_id'] = $this->input->get_post('sku_id');
        $data['num'] = $this->input->get_post('num');
        if(!$data['item_id'] || !$data['sku_id']){
            show_error('缺少参数','500','下单时发生错误');
        }
        $res = $this->get_model('Buy_model','get_order_item',$data);
        if($res['return_code']){
            show_error($res['return_msg'],'500','下单时发生错误');
        }else{
            return $res['data'];
        }
    }

    /**
     * 创建订单
     */
    public function create_order(){
        $data = $this->input->post();
        if(!isset($data['item_id']) || !$data['item_id'] || !isset($data['sku_id']) || !$data['sku_id'] || !isset($data['num']) || !$data['num']){
            echo json_encode(array('status'=>false,'msg'=>'缺少商品参数'));
            exit;
        }
        if(!isset($data['state']) || !$data['state'] || !isset($data['city']) || !$data['city'] || !isset($data['district']) || !$data['district'] || !isset($data['address']) || !$data['address']){
            echo json_encode(array('status'=>false,'msg'=>'请填写完整的地址'));
            exit;
        }
        if(!isset($data['name']) || !$data['name'] || !isset($data['mobile']) || !$data['mobile']){
            echo json_encode(array('status'=>false,'msg'=>'请填写收货人姓名和手机号'));
            exit;
        }
        $res = $this->get_model('Buy_model','post_order',$data);
        if($res['return_code']){
            $return = array('status'=>false,'msg'=>$res['return_msg']);
        }else{
            $return = array('status'=>true,'data'=>$res['data']);
        }
        echo json_encode($return);
        exit;
    }

    /**
     * 取消订单
     */
    public function cancel_order(){
        $data['tid'] = $this->input->get_post('tid');
        if(!$data['tid']){
            echo json_encode(array('status'=>false,'msg'=>'缺少订单参数'));
            exit;
        }
        $res = $this->get_model('Buy_model','cancel_order',$data);
        if($res['return_code']){
            $return = array('status'=>false,'msg'=>$res['return_msg']);
        }else{
            $return = array('status'=>true,'data'=>$res['data']);
        }
        echo json_encode($return);exit;
    }

    /**
     * 获取用户的收货地址
     * @param $type 1国内，2国外
     * @return array
     */
    public function get_user_address($type=0){
//        $this->load->Model('Users_model');
//        $user_info = $this->Users_model->get_user_state();
//        $data['mobile'] = $user_info['data']['username'];
        $data['type'] = $type;
        $res = $this->get_model('Users_model','get_user_address',$data);
        if($res['return_code'] == 0){
            return $res['data'];
        }else{
            return array(); //返回空数组;
        }
    }

    /**
     * 新增\编辑用户收货地址
     */
    public function save_address(){
        $data = $this->input->post();
        $res = $this->get_model('Users_model','save_address',$data);
        if($res['return_code']){
            $return = array('status'=>false,'msg'=>$res['return_msg']);
        }else{
            $return = array('status'=>true,'data'=>$res['data']);
        }
        echo json_encode($return);
        exit;
    }

    /**
     * 删除用户收货地址
     */
    public function delete_buyer_address(){
        $data['addr_id'] = $this->input->get_post('addr_id');
        if(!$data['addr_id']){
            echo json_encode(array('status'=>false,'msg'=>'请选择要删除的地址'));
            exit;
        }
        $res = $this->get_model('Users_model','delete_address',$data);
        if($res['return_code']){
            $return = array('status'=>false,'msg'=>$res['return_msg']);
        }else{
            $return = array('status'=>true,'data'=>$res['data']);
        }
        echo json_encode($return);
        exit;
    }
}