<?php
namespace App\Http\Controllers\Weixin;

use GuzzleHttp\Psr7\Uri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redis;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

use App\Model\WeixinUserModel;

class WxController extends Controller
{
    //首次接入
    public function valid(){
        echo $_GET['echostr'];
    }
 
    /* 
    接收微信推送事件
    */
  public function wxEvent()
    {
        echo $_GET['echostr'];die;
        //使用Guzzle
        $client = new Client();
        $xml_str = file_get_contents("php://input");
        $log_str = '>>>>>>>>>'.date("Y-m-d H:i:s").$xml_str."\n";
        file_put_contents("logs/wx_event.log",$log_str,FILE_APPEND);
        //日志文件
        $xml_obj = simplexml_load_string($xml_str);
        //处理业务逻辑
        $msg_type=$xml_obj->MsgType;    //消息类型
        $open_id = $xml_obj->FromUserName;  //用户openid
        $app = $xml_obj->ToUserName;    //公众号ID  
        echo "weixin";
    }
    

}
?>
