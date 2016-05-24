<?php
/**
 * Created by PhpStorm.
 * User: meijiang
 * Date: 2016/4/27
 * Time: 18:32
 */
class MY_Controller extends CI_Controller{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('bbmt');
    }


    public function get_model($model_name, $fun_name, $param = array()) {
        $this->load->model($model_name);
        $res   = $this->$model_name->$fun_name($param);

//        if($res['return_code'] == 100) {
//            exit('please login');
//        }

        return $res;
    }

    /*
     * @todo :封装分页部分
     * @param :int $total 总的记录条数
     * @param :string $url 基础url地址
     * @param :int $limit 每页显示条数
     * @param :string $querystr 携带地址查询参数
     */

    public function page($url,$total_pages,$cur_page){
        $this->load->library('pagination');
        $config['base_url'] = $url;
        $config['cur_page'] = $cur_page ? $cur_page : 1;
        $config['total_pages'] = $total_pages;
        $config['use_page_numbers'] = true;
        $config['num_links'] = 5;
        $config['first_link'] = "首页";
        $config['prev_link'] = "上一页";
        $config['next_link'] = "下一页";
        $config['last_link'] = "尾页";
        $config['page_query_string'] = true;
        $config['query_string_segment'] = 'page';
        $config['cur_tag_open'] = '<span class="current">';
        $config['cur_tag_close'] = '</span>';



        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }
}