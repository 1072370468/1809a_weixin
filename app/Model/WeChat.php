<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WeChat extends Model
{
    /**
     * @content 发送消息
     */
    public static function sendMsg($postObj,$Content)
    {
        //获取发送人
        $ToUserName = $postObj -> FromUserName;
        //获取接收人
        $FromUserName = $postObj -> ToUserName;
        //当前时间戳
        $CreateTime = time();
        $textMsg = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[text]]></MsgType>
            <Content><![CDATA[%s]]></Content>
        </xml>";
        $resultStr = sprintf($textMsg,$ToUserName,$FromUserName,$CreateTime,$Content);
        echo $resultStr;
    }
    /**
     * @content 图灵机器人的回复方法
     */
    public static function tuLing($keyWords)
    {
        $url = 'http://openapi.tuling123.com/openapi/api/v2';
        $data = [
            'reqType' => 0,
            'perception' => [
                'inputText' => [
                    'text' => $keyWords
                ],
            ],
            'userInfo' => [
                'apiKey' => '3afa48e52770400b8a4c0a5c723fc2b5',
                'userId' => '3afa48e52770400b8a4c0a5c723fc2b5',
            ]
        ];
        $dataJson = \json_encode($data);
        $output = self::curlPost($url,$dataJson);
        $output = \json_decode($output,true);
        return $output;
    }
    /**
     * @content 发送请求
     */
    public static function curlPost($url,$data)
    {
        //初使化init方法
        $ch = curl_init();
        //指定URL
        curl_setopt($ch, CURLOPT_URL, $url);
        //设定请求后返回结果
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //声明使用POST方式来进行发送
        curl_setopt($ch, CURLOPT_POST, 1);
        //发送什么数据呢
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        //忽略证书
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        //忽略header头信息
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //设置超时时间
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        //发送请求
        $output = curl_exec($ch);
        //关闭curl
        curl_close($ch);
        //返回数据
        return $output;

    }
}