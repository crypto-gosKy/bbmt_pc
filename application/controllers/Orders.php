<?php
/**
 * Created by PhpStorm.
 * User: wangliang
 * Date: 16/4/28
 * Time: 下午3:35
 */

class Orders extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

    }

    /**
     * 订单列表
     */
    public function index()
    {
        $root           = array();
        $param          = array();
        $param['page']  = intval($this->input->get('page')) == 0 ? 1 : intval($this->input->get('page'));

        //tid
        $tid = $this->input->get('tid');
        if($tid != null && intval($tid) > 0) {
            $param['tid'] = intval($tid);
        }

        //buyer_name
        $buyer_name = trim($this->input->get('buyer_name'));
        if(!empty($buyer_name)) {
            $param['buyer_name'] = $buyer_name;
        }

        //buyer_mobile
        $buyer_mobile = trim($this->input->get('buyer_mobile'));
        if(!empty($buyer_mobile)) {
            $param['buyer_mobile'] = $buyer_mobile;
        }

        //goods_name
        $goods_name = trim($this->input->get('goods_name'));
        if(!empty($goods_name)) {
            $param['goods_name'] = $goods_name;
        }

        //order_status
        $order_status = $this->input->get('order_status');
        if($order_status != null && intval($order_status) > - 1) {
            $param['status'] = $order_status;
        }

        //begin_date
        $begin_date = trim($this->input->get('begin_date'));
        if(!empty($begin_date)) {
            $param['start_time'] = $begin_date;
        }

        //end_date
        $end_date = trim($this->input->get('end_date'));
        if(!empty($end_date)) {
            $param['end_time'] = $end_date;
        }

        $data                = $this->get_model('Orders_model', 'get_orders', $param);

        if(isset($data['data']['trade_list'])) {
            $root['orders']      = $data['data']['trade_list'];
            $root['page']        = $this->page(site_url('orders/index'), $data['data']['total_page_num'], $param['page']);
            $root['total_page']  = $data['data']['total_page_num'];
            $root['total_count'] = $data['data']['total_count'];
        } else {
            $root['orders']      = array();
            $root['page']        = $this->page(site_url('orders/index'), 1, $param['page']);
            $root['total_page']  = 1;
            $root['total_count'] = 0;
        }

        $root['cur_page']    = $param['page'];

        $root['begin_date']  = date('Y-m-d', strtotime('-90 day'));
        $root['now_date']    = date('Y-m-d', time());

        if($this->input->is_ajax_request()) {
            echo json_encode($root);
        } else {
            $this->load->view('Orders/orders_list', $root);
        }
    }

    public function no_pay() {
        $param = $this->input->get();
        $param['trade_type'] = $this->input->get('trade_type');
        $param['status'] = 1;
        $param['page']          = isset($param['page']) ? $param['page'] : 1;
        $data = $this->get_model('Orders_model', 'get_orders', $param);
        //print_r($data);exit;
        if(isset($data['data']['trade_list'])) {
            $root['orders']      = $data['data']['trade_list'];
            $root['page']        = $this->page(site_url('orders/no_pay'), $data['data']['total_page_num'], $param['page']);
            $root['total_page']  = $data['data']['total_page_num'];
        } else {
            $root['orders']      = array();
            $root['page']        = $this->page(site_url('orders/no_pay'), 1, $param['page']);
            $root['total_page']  = 1;
        }

        $root['cur_page']    = $param['page'];
        $root['total_count'] = isset($data['data']['total_count']) ? $data['data']['total_count'] : 0;
        $root['begin_date']  = date('Y-m-d', strtotime('-90 day'));
        $root['now_date']    = date('Y-m-d', time());

        if($this->input->is_ajax_request()) {
            echo json_encode($root);
        } else {
            $this->load->view('Orders/no_pay',$root);
        }

    }

    /**
     * 订单详情
     */
    public function detail() {
        $root  = array();
        $param = array();
        $tid   = intval($this->input->get('tid'));

        if($tid <= 0) {
            exit('error');
        }

        $param['tid'] = $tid;

        $data = $this->get_model('Orders_model', 'get_detail', $param);
//        echo json_encode($data);exit;
        $root['order'] = $data['data'];

        $this->load->view('Orders/orders_detail', $root);
    }

    /**
     * 导出订单
     */
    public function export() {
        $this->load->model('Orders_model');
        $res = $this->Orders_model->export();

        $filename = $res['filename'];
        $path     = $res['path'];

        $file = fopen($path,"r"); // 打开文件

        Header("Content-type: application/octet-stream");
        Header("Accept-Ranges: bytes");
        Header("Accept-Length: ".filesize($path));
        Header("Content-Disposition: attachment; filename=" . $filename);
        echo fread($file,filesize($path));
        fclose($file);
    }

    /**
     * 支付方式页面
     */
    public function payment(){
        $view_data['tid'] = $this->input->get_post('tid');
        if(!$view_data['tid']){
            echo json_encode(array('status'=>false,'msg'=>'缺少订单id'));
            exit;
        }
        $res = $this->get_model('Orders_model', 'get_detail_topay', array('tid'=>$view_data['tid']));
        $view_data['detail'] = $res['data'];
//        var_dump($view_data['detail']);exit;
        $this->load->view('Orders/orders_payment',$view_data);
    }

    /**
     * 取消订单接口
     */
    public function cancel() {
        $param        = array();
        $param['tid'] = $this->input->get_post('tid');

        $res = $this->get_model('Orders_model', 'do_cancel', $param);

        if($this->input->is_ajax_request()) {
            echo json_encode($res);
        } else {
            $this->load->view('Orders/orders_list');
        }
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

    /**
     * 确认收货接口
     */
    public function confirm_receive_goods(){
        $param['tid'] = intval($this->input->get_post('tid'));
        $res = $this->get_model('Orders_model','confirm_receive',$param);
        echo  json_encode($res);
        exit;
    }

}