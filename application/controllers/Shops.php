<?php

/**
 * Created by PhpStorm.
 * User: wangliang
 * Date: 16/5/1
 * Time: 上午1:38
 */
class Shops extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

    }

    /**
     * 店铺基本信息
     */
    public function index()
    {
        $root         = array();
        $data         = $this->get_model('Shops_model', 'get_info');
        $root['info'] = $data['data'];

        // load view
        $this->load->view('Shops/shops_info', $root);
    }

    /**
     * 店铺收入界面
     */
    public function data()
    {
        $root                = array();

        // 近7天
        $param               = array();
        $param['begin_date'] = date('Y-m-d', strtotime('-7 day'));
        $param['end_date']   = date('Y-m-d', time());

        // get data
        $data                = $this->get_model('Shops_model', 'get_income', $param);

        // set data
        $root['page']        = $this->page(site_url('shops/income'), $data['data']['total_page_num'], $data['data']['cur_page']);
        $root['total_page']  = $data['data']['total_page_num'];
        $root['cur_page']    = $data['data']['cur_page'];
        $root['income_list'] = $data['data']['income_list'];
        $root['total_count'] = $data['data']['total_count'];
        $root['begin_date']  = date('Y-m-d', strtotime('-7 day'));
        $root['now_date']    = date('Y-m-d', time());

        // load view
        $this->load->view('Shops/incomes_list', $root);
    }

    /**
     * 获取店铺收入 ajax
     */
    public function income()
    {
        $root                = array();

        // 近7天
        $param               = array();
        $param['begin_date'] = $this->input->get('begin_date');
        $param['end_date']   = $this->input->get('end_date');
        $param['page']       = intval($this->input->get('page'));

        // get data
        $data                = $this->get_model('Shops_model', 'get_income', $param);

        // set data
        $root['page']        = $this->page(site_url('shops/income'), $data['data']['total_page_num'], $data['data']['cur_page']);
        $root['total_page']  = $data['data']['total_page_num'];
        $root['cur_page']    = $data['data']['cur_page'];
        $root['income_list'] = $data['data']['income_list'];
        $root['total_count'] = $data['data']['total_count'];

        // export json
        if($this->input->is_ajax_request()) {
            echo json_encode($root);
        } else {
            $this->data();
        }
    }
}