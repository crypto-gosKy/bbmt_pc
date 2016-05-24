<?php
/**
 * Created by PhpStorm.
 * User: meijiang
 * Date: 2016/5/3
 * Time: 14:02
 */
class Logistics extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 商品物流跟踪接口
     */
    public function get_logistics_trace_info(){
        $data['invoice_no'] = $this->input->get('invoice_no');
        $data['logistics_company'] = $this->input->get('logistics_company');
        if(!$data['invoice_no'] || !$data['logistics_company']){
            echo json_encode(array('status'=>false,'msg'=>'缺少物流参数'));
            exit;
        }
        $res = $this->get_model('Logistics_model','get_logistics_info',$data);
        if($res['return_code']){
            $return = array('status'=>false,'msg'=>$res['return_msg']);
        }else{
            $return = array('status'=>true,'data'=>$res['data']);
        }
        echo json_encode($return);
        exit;
    }
}