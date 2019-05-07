<?php
namespace App\Http\Controllers\Weixin;

use App\Model\WeChat;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
// use GuzzleHttp\Client;
use App\Model\WeChatModel;
use Illuminate\Support\Facades\Storage;
class WxController extends Controller
{
    //首次接入
    public function valid(Request $request)
    {
            //接收echostr
        $echostr = $request->echostr;
        //判断echostr 是否存在
        if($this->CheckSignatrue($request)){
            echo $echostr;
        }else{
            $this->responseMsg();
        }
    }
    public function responseMsg(){
        //接收微信推送过来的信息
        $postStr=file_get_contents("php://input");
//        dd($postStr);
        ///处理xml
        $postObj=simplexml_load_string($postStr,"SimpleXMLElement",LIBXML_NOCDATA);
        $fromUserName=$postObj->FromUserName;
        $toUserName=$postObj->ToUserName;
        $time=time();
        //判断是不是事件
        if($postObj->MsgType == 'event'){
            //判断是不是关注事件
            if($postObj->Event == 'subscribe'){
                //首次关注回复文本信息
                $Content = env('CONTENT');
                WeChat::sendMsg($postObj,$Content);
            }
        }
        //获取用户发送的信息
        $keyWords=(string)$postObj->Content;
        //关键字回复
        $config=config('Keywords');
//        dd($config[$keyWords]);
        if(isset($config[$keyWords])){
            WeChat::sendMsg($postObj,$config[$keyWords]);
        }else{
            //调用图灵机器人
            $res = WeChat::tuLing($keyWords);
            $Content=$res['results'][0]['values']['text'];
            //发送消息
            WeChat::sendMsg($postObj,$Content);
        }
    }
   public function CheckSignatrue($request){
        $nonce = $request->nonce;
        $timestamp=$request->timestamp;
        $signature=$request->signature;
        $token = env("WXTOKEN");
        $tmparr=[$token,$timestamp,$nonce];
        sort($tmparr);
        $tmpstr=implode($tmparr);
        $str = sha1($tmpstr);
        if ($str == $signature){
            return true;
        }else{
            return false;
        }
   }



}
?>
