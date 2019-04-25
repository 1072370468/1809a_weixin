<?php
namespace App\Http\Controllers\Crontab;

use GuzzleHttp\Psr7\Uri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp\Client;
use App\Model\OrderModel;
use Illuminate\Support\Facades\Storage;
class CrontabController extends Controller
{
    //删除过期订单(超过半小时未支付的订单)
  public function delorders(){
    echo __METHOD__."\n";
    $all=OrderModel::all()->toArray();
    foreach($all as $k=>$v){
        if(time()-$v['add_time']>12 && $v['pay_time']==0){
            //置为删除状态
            OrderModel::where(['oid'=>$v['oid']])->update(['is_delete'=>1]);
        }
    }
    echo '<pre>';print_r($all);echo '</pre>';
  }
}
?>
