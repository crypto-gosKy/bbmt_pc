<?php
/**
 * Created by PhpStorm.
 * User: meijiang
 * Date: 2016/4/27
 * Time: 14:32
 */
class Goods_model extends MY_Model{
    /**
     * 获取商品列表
     * @param $data
     * @return bool|mixed
     */
    public function lists($data){
        $url = $this->api_url.'api/item/item_list';
        $res = $this->postCurl($url,$data);
        if(!$this->is_show_price() && $res['return_code'] == 0){
            foreach($res['data']['item_list'] as $key => &$val){
                $val['price'] = '--';
                $val['market_price'] = '--';
            }
        }
        return $res;
    }

    /**
     * 商品详情
     * @param $params
     * @return bool|mixed
     */
    public function get_detail($params){
        $url = $this->api_url.'/api/item/desc';
        $res =  $this->postCurl($url,$params);
        if(!$this->is_show_price() && $res['return_code'] == 0){
            $res['data']['price'] = '--';                    //价格
            $res['data']['market_price'] = '--';            //市场价格
            foreach($res['data']['specs'] as $key => &$val){ //规格
                $val['price'] = '--';
                $val['price1'] = '--';
            }
            foreach($res['data']['tuijian'] as $key => &$val){   //推荐商品
                $val['price'] = '--';
                $val['market_price'] = '--';
            }
        }
        return $res;
    }

    /**
     * 获取全部类目
     * @return bool|mixed
     */
    public function get_cats(){
        $url = $this->api_url.'/api/cat/list';
        return $this->postCurl($url);
    }

    /**
     * 获取广告图片
     * @param $params
     * @return bool|mixed
     */
    public function get_advertisements($params){
        $url = $this->api_url.'/api/item/advertisements';
        return $this->postCurl($url,$params);
    }

    /**
     * 获取商品库存
     * @param $params
     * @return bool|mixed
     */
    public function get_goods_quantity($params){
        $url = $this->api_url.'/api/item/quantity';
        return $this->postCurl($url,$params);
    }

    /**
     * 获取购买者记录列表
     * @param $params
     * @return bool|mixed
     */
    public function get_buyer_record($params){
        $url = $this->api_url.'api/itembuyer';
        return $this->postCurl($url,$params);
    }

    /**
     * 全部分类下的商品（商品首页）
     * @return array|mixed
     */
    public function get_all_cats_items(){
        $url = $this->api_url.'api/item/home';
        $res =  $this->getCurl($url);
        if(!$this->is_show_price() && $res['return_code'] == 0){
            foreach($res['data'] as $k => &$val){
                foreach($val['items'] as $key => &$item){
                    $item['price'] = '--';
                    $item['market_price'] = '--';
                }
            }
        }
        return $res;
    }

    /**
     * 获取广告图片
     */
    public function get_advs() {
        $url = $this->api_url.'api/activity/advs';
        $result = $this->getCurl($url);

        return $result;
    }

    /**
     * 获取运费模板运费
     * @param $params
     * @return array|mixed
     */
    public function get_logistics_fee($params){
        $url = $this->api_url.'api/item/logistics_fee';
        $result = $this->postCurl($url,$params);

        return $result;
    }

}