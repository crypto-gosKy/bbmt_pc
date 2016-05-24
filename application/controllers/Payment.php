<?php
/**
 * Created by PhpStorm.
 * User: meijiang
 * Date: 2016/4/29
 * Time: 17:41
 */
class Payment extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 获取支付宝支付表单
     */
    public function get_payment(){
        $data['tid'] = $this->input->get_post('tid');
        if(!$data['tid']){
            echo json_encode(array('status'=>false,'msg'=>'未知的交易单号'));
            exit;
        }
        $res = $this->get_model('Payment_Model','alipay',$data);
        if($res['return_code']){
            $return = array('status'=>false,'msg'=>$res['return_msg']);
        }else{
            $return = array('status'=>true,'data'=>$res['data']);
        }
        echo json_encode($return);
        exit;
    }
}