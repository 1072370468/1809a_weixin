<?php
namespace App\Http\Controllers\Weixin;

use GuzzleHttp\Psr7\Uri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp\Client;
use App\Model\GoodsModel;
use Illuminate\Support\Facades\Storage;
class PhpinfoController extends Controller
{
  public function goodslist(){
    $goods_info=GoodsModel::get();
    // print_r($goods_info);die;
    // $data=[
    //   'goods' => $goods_info
    // ];
    return view('wx.goodslist',['goods_info'=>$goods_info]);
  }
  public function shoplist($id){
      // echo __METHOD__;echo "</br>";
      $goods_id=intval($id);
      if(!$id){
        die('参数错误');
      }
       $goods_info=GoodsModel::where(['goods_id'=>$id])->first();
      // print_r($goods_info);
      if($goods_info == NULL){
        header('Refresh:2;url=/');
        die("商品不存在,自动跳转至网站首页");
      }
      $view=0;
      $redis_view_key='count:view:goods_id:'.$goods_id;
    //  echo $redis_view_key;echo "</hr>";
    //获取浏览量
    $view=Redis::incr($redis_view_key);   //浏览量+1
      // var_dump($view);  
    $data=[
        'goods' => $goods_info,
        'view' => $view
      ];
      return view('wx.detail',$data);
    }
    public function cachegoods($id){
      $goods_id=intval($id);
           //缓存商品信息
           $redis_cache_goods_key='h:goods_info:'.$goods_id;
           // echo $redis_cache_goods_key;
        $cache_info=Redis::hGetAll($redis_cache_goods_key);
        // var_dump($cache_info);die;
        if($cache_info){
          echo "cache";
          print_r($cache_info);
        }else{
          echo "no";
          //无缓存  缓存商品信息
          $goods_info=GoodsModel::where(['goods_id'=>$id])->first()->toArray();
          // print_r($goods_info);
          Redis::hMset($redis_cache_goods_key,$goods_info);    
        }
     
    }

}
?>
