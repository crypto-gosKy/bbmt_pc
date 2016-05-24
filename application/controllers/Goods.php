<?php
/**
 * Created by PhpStorm.
 * User: meijiang
 * Date: 2016/4/27
 * Time: 14:20
 */
class Goods extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $activity = $this->activity();
        if($activity['status']){
            $view_data['activity'] = $activity['data']['trade_list'];
        }
        $items = $this->get_all_cats_items();
        if(!$items['return_code']){
            $view_data['allCats'] = $items['data'];
        }
        $view_data['parent_cats'] = $this->get_parent_cats();

        $this->load->view('Goods/index',$view_data);
    }

    /**
     * 商品列表
     * @return string
     */
    public function goods_list(){
        $type = 1;  //国内商品
        $data = $this->_list($type);
        $view_data = array(
            'goods_list'=>$data['list']['data']['item_list'],
            'cats'=>$data['cats'],
            'cats_json'=>$data['cats_json'],
            'page'=>$data['page'],
            'total_page_num'=>$data['list']['data']['total_page_num'],
            'total_count_num'=>$data['list']['data']['total_count_num'],
            'parent_cats'=>$data['parent_cats']
        );

        //获取广告图片
        $banners = $this->get_model('Goods_model', 'get_advs');
        if($banners) {
            foreach($banners['data'] as $banner) {
                if($banner['type'] == 0) {
                    $view_data['banner'] = $banner;
                }
            }
        }

        $this->load->view('Goods/goods_list',$view_data);
    }

    /**
     * 商品详情
     */
    public function detail(){
        $detail = $this->goods_detail();
        $view_data['detail'] = $detail;
        $view_data['parent_cats'] = $this->get_parent_cats();
        $this->load->view('Goods/goods_details',$view_data);
    }

    /**
     * 获取某个商品的库存
     * @return array
     */
    public function get_goods_quantity(){
        $res = $this->goods_quantity_logic();
        if($this->input->is_ajax_request()){    //接口请求
            echo json_encode($res);
            exit;
        }
        echo json_encode($res);
    }

    /**
     * 获取某个商品的买家记录
     * @return array
     */
    public function get_buyer_record(){
        $res = $this->buyer_list_logic();
        if($this->input->is_ajax_request()){    //接口请求
            echo json_encode($res);
            exit;
        }
        echo  json_encode($res);
    }

    /**
     * 获取所有分类下的商品
     * @return mixed
     */
    protected function get_all_cats_items(){
        return $this->get_model('Goods_model','get_all_cats_items');
    }

    protected function buyer_list_logic(){
        $param_data['item_id'] = $this->input->get_post('item_id');
        $param_data['page'] = $this->input->get_post('page');
        if(!$param_data['item_id'] || !$param_data['page']){
            return array('status'=>false,'msg'=>'缺少参数');
        }
        $res = $this->get_model('Goods_model','get_buyer_record',$param_data);
        if($res['return_code']){
            return array('status'=>false,'msg'=>'接口有误');
        }
        return array('status'=>true,'data'=>$res['data']);
    }

    protected function goods_quantity_logic(){
        $param_data['item_id'] = $this->input->get_post('item_id');
        $param_data['sku_id']  = $this->input->get_post('sku_id');
        if(!$param_data['item_id']){
            return array('status'=>false,'msg'=>'缺少商品id');
        }
        $res = $this->get_model('Goods_model','get_goods_quantity',$param_data);
        if($res['return_code']){
            return array('status'=>false,'msg'=>$res['return_msg']);
        }
        return array('status'=>true,'data'=>$res['data']);
    }

    /**
     * 商品详情数据处理
     * @return array
     */
    protected function goods_detail(){
        $param_data['item_id'] = $this->input->get_post('item_id');
        if(!$param_data['item_id']){
            show_error('缺少参数',300,'请求遇到错误');
        }
        $param_data['item_activity_id'] = $this->input->get_post('item_activity_id');
        if($param_data['item_activity_id'] > 0){  //活动相关设置
            $param_data['now_time'] = time();
            $param_data['activity_start_time'] = $this->input->get_post('activity_start_time');
            $param_data['activity_end_time'] = $this->input->get_post('activity_end_time');
        }

        $detail = $this->get_model('Goods_model','get_detail',$param_data);
        if($detail['return_code']){
            $detail['data'] = array();
            show_error('该商品已经下架或者删除！','404','无效的商品：');
        }else{
            $detail['data']['desc'] = htmlspecialchars_decode($detail['data']['desc']);
        }

        return $detail['data'];
    }

    /**
     * 国外商品列表
     * @return string
     */
    public function foreign_goods_list(){
        $type = 2;  //保税区商品
        $data = $this->_list($type);
        $view_data = array(
            'goods_list'=>$data['list']['data']['item_list'],
            'cats'=>$data['cats'],
            'cats_json'=>$data['cats_json'],
            'total_page_num'=>$data['list']['data']['total_page_num'],
            'total_count_num'=>$data['list']['data']['total_count_num'],
            'page'=>$data['page'],
            'parent_cats'=>$data['parent_cats']
        );

        //获取广告图片
        $banners = $this->get_model('Goods_model', 'get_advs');
        if($banners) {
            foreach($banners['data'] as $banner) {
                if($banner['type'] == 1) {
                    $view_data['banner'] = $banner;
                }
            }
        }

        $this->load->view('Goods/goods_list2',$view_data);
    }

    /**
     * 商品搜索页和接口
     */
    public function search(){
        $data           = $this->input->get();
        $data['page']  = isset($data['page']) ? $data['page'] : 1;
        $res            = $this->get_model('Goods_model','lists',$data);
        $cats           = $this->goods_cats();
        $cats_json      = json_encode($cats);
        $parent_cats    = $this->get_parent_cats();  //全部一级分类
        $url            = site_url('goods/search');
        if(isset($res['data']['total_page_num'])){
            $page       = $this->page($url,$res['data']['total_page_num'],$data['page']);
        }
        $view_data = array(
            'goods_list'       => isset($res['data']['item_list']) ? $res['data']['item_list'] : array(),
            'cats'              => $cats,
            'cats_json'        => isset($cats_json) ? $cats_json : '',
            'page'              => isset($page) ? $page : '',
            'total_page_num'   => isset($res['data']['total_page_num']) ? $res['data']['total_page_num'] : '',
            'total_count_num'  => isset($res['data']['total_count_num']) ? $res['data']['total_count_num'] : '',
            'parent_cats'      => isset($parent_cats) ? $parent_cats : array(),
            'keyword'           => isset($data['keyword']) ? $data['keyword'] : '',
            'search_cid'        => isset($data['cat_id']) ? $data['cat_id'] : '',
            'item_activity_id' => isset($data['item_activity_id']) ? $data['item_activity_id'] : '',
            'brand_id'          => isset($data['brand_id']) ? $data['brand_id'] : ''
        );

        $this->load->view('Goods/search',$view_data);
    }

    /**
     * 搜索接口
     */
    public function ajax_search(){
        $data           = $this->input->get();
        $data['page']  = isset($data['page']) ? $data['page'] : 1;
        $res            = $this->get_model('Goods_model','lists',$data);
        if($res['return_code']){
            echo json_encode(array('status'=>false,'msg'=>$res['return_msg']));
            exit;
        }
        $cats           = $this->goods_cats();
        $url            = site_url('goods/search');
        $page           = $this->page($url,$res['data']['total_page_num'],$data['page']);
        $res['data']['page'] = $page;
        $res['data']['cats'] = $cats;
        echo json_encode(array('status'=>true,'data'=>$res['data']));
        exit;

    }

    public function ajax_logistics_fee(){
        $data['item_id'] = $this->input->get_post('item_id');
        $data['send_city']    = $this->input->get_post('send_city');
        if(!$data['item_id'] || !$data['send_city']){
            echo json_encode(array('status'=>false,'msg'=>'缺少参数'));
            exit;
        }
        $res = $this->get_model('Goods_model','get_logistics_fee',$data);
        if($res['return_code']){
            $return = array('status'=>false,'msg'=>$res['return_msg']);
        }else{
            $return = array('status'=>true,'data'=>$res['data']);
        }
        echo json_encode($return);
        exit;
    }

    /**
     * 商品列表逻辑处理
     * @param $type
     * @return array|string
     */
    protected function _list($type){
        $param_data = array(
            'cat_id' => $this->input->get_post('cid'),
            'brand_id' => $this->input->get_post('brand_id'),
            'type' => $this->input->get_post('type') ? $this->input->get_post('type') : $type,
            'keyword' => $this->input->get_post('keyword'),
            'page'  => $this->input->get_post('page'),
            'sort_money' => $this->input->get_post('sort_money')
        );
        $data = $this->get_model('Goods_model','lists',$param_data);
        if($type == 1){
            $url = site_url('goods/goods_list');
        }else{
            $url = site_url('goods/foreign_goods_list');
        }
        $page = $this->page($url,$data['data']['total_page_num'],$param_data['page']);
        $cats = $this->goods_cats();
        $cats_json = json_encode($cats);
        $cats = $this->dist_cats($cats,$type);    //区分国内和国外分类，默认国内商品分类
        $parent_cats = $this->get_parent_cats();  //全部一级分类

        return array('list'=>$data,'page'=>$page,'cats'=>$cats,'cats_json'=>$cats_json,'parent_cats'=>$parent_cats);
    }

    /**
     * 商品分类
     * @return mixed
     */
    protected function goods_cats(){
//        $this->load->library('mem');
//        $mem_data = $this->mem->get('mem_cats');
//        if(!$mem_data){
//            $mem_data = $this->get_model('Goods_model','get_cats');
//            $this->mem->save('mem_cats',$mem_data,MEMCACHE_COMPRESSED,7200);  //重新存memcache
//        }
//        $data = $mem_data;
        $data = $this->get_model('Goods_model','get_cats');
        if($data['return_code']){
            $data['data'] = array();
        }
        return $data['data'];
    }

    /**
     * 国内商品分类和保税区商品分类
     * @param $cats
     * @param $type
     * @return mixed
     */
    protected function dist_cats($cats,$type){
        if($type == 2){
            return $cats['cat_list_2'];
        }else{
            return $cats['cat_list_1'];
        }
    }

    /**
     * 获取全部一级分类
     * @return array
     */
    public function get_parent_cats(){
        $all_cats = $this->goods_cats();
        $cats = array();
        $foreign_cats = array();
        if(isset($all_cats['cat_list_1']) && $all_cats['cat_list_1'] != ''){
            foreach($all_cats['cat_list_1'] as $key => $val){
                $cats[$val['cid']] = $val['cat_name'];
            }
        }
        if(isset($all_cats['cat_list_1']) && $all_cats['cat_list_1'] != ''){
            foreach($all_cats['cat_list_2'] as $key => $val){
                $foreign_cats[$val['cid']] = $val['cat_name'];
            }
        }

        foreach($cats as $k =>$v){
            foreach($foreign_cats as $key => $val){
                if($key == $k){
                    unset($foreign_cats[$key]);
                }else{
                    $cats[$key] = $val;
                }
            }
        }
        $parent_cats = $cats;
        return $parent_cats;
    }

    /**
     * 商品类别请求接口
     */
    public function ajax_goods_list(){
        $data = $this->input->get();
        $data['cat_id'] = $this->input->get_post('cat_id');
        $data['brand_id'] = $this->input->get_post('brand_id');
        $data['page'] = isset($data['page']) ? $data['page'] : 1;
//        if($data['cat_id'] == '' && $data['brand_id'] == ''){
//            echo json_encode(array('status'=>false,'msg'=>'缺少参数'));
//            exit;
//        }
        if(!isset($data['type']) || !$data['type']){
            echo json_encode(array('status'=>false,'msg'=>'请选择类型'));
            exit;
        }
        $res = $this->get_model('Goods_model','lists',$data);
        if($data['type'] == 1){
            $url = site_url('goods/goods_list');
        }else{
            $url = site_url('goods/foreign_goods_list');
        }
        if($res['return_code']){
            $return = array('status'=>false,'msg'=>$res['return_msg']);
        }else{
            $res['data']['page'] = $this->page($url,$res['data']['total_page_num'],$data['page']);
            $return = array('status'=>true,'data'=>$res['data']);
        }
        echo json_encode($return);
        exit;
    }

    protected function get_item_activity_list(){
        $res = $this->get_model('Item_activity_model','get_item_activity_list');
        if($res['return_code']){
            $return = array('status'=>false,'msg'=>$res['return_msg']);
        }else{
            $return = array('status'=>true,'data'=>$res['data']);
        }
        return $return;
    }

    /**
     * 获取活动商品
     * @param $item_activity_id
     * @return array
     */
    protected function get_activity_items($item_activity_id){
        $data['item_activity_id'] = $item_activity_id;
        if(!$data['item_activity_id']){
             return (array('status'=>false,'msg'=>'缺少活动参数'));
        }
        $res = $this->get_model('Item_activity_model','get_item_goods',$data);
        if($res['return_code']){
            $return = array('status'=>false,'msg'=>$res['return_msg']);
        }else{
            $return = array('status'=>true,'data'=>$res['data']);
        }
        return $return;
    }

    /**
     * 商品活动逻辑处理（php渲染页面用）
     * @return array
     */
    protected function activity(){
        $activity_list = $this->get_item_activity_list();
        if($activity_list['status']){
            foreach ($activity_list['data']['trade_list'] as &$item) {
                $item_list = $this->get_activity_items($item['item_activity_id']);   //获取对应活动的商品
                if($item_list['status']){
                    $item['item_list'] = $item_list['data']['item_list'];
                }else{
                    $item['item_list'] = array();
                }
            }
        }
        return $activity_list;
    }

}