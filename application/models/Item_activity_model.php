<?php
/**
 * Created by PhpStorm.
 * User: meijiang
 * Date: 2016/5/3
 * Time: 14:54
 */
class Item_activity_model extends MY_Model{
    /**
     * 商品活动列表
     * @return array|mixed
     */
    public function get_item_activity_list(){
        $url = $this->api_url.'api/activity/active_list';
        return $this->getCurl($url);
    }

    public function get_item_goods($params){
        $url = $this->api_url.'api/item/item_list';
        $res =  $this->getCurl($url,$params);

        if($res['return_code'] == 0 && !$this->is_show_price()){
            foreach($res['data']['item_list'] as $key => &$item){
                $item['price'] = '--';
                $item['market_price'] = '--';
            }
        }
        return $res;
    }
}