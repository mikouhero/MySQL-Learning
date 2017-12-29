<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Loader;
use app\demo\Rest;
use app\demo\PhpMailer;
// 应用公共文件
// loader::import('Rest','EXTEND_PATH');
// include('../extend/Rest.class.php'); //影响验证码
// 发送短信的函数

function sendTemplateSMS($to,$datas,$tempId)
{
    //主帐号,对应开官网发者主账号下的 ACCOUNT SID
    $accountSid= '8a216da86077dcd001609aa56dd81307';
    //主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
    $accountToken= '4baa9adcd259467189178f0156dd5fff';
    //应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
    //在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
    $appId='8a216da86077dcd001609aa56e3d130e';
    //请求地址
    //沙盒环境（用于应用开发调试）：sandboxapp.cloopen.com
    //生产环境（用户应用上线使用）：app.cloopen.com
    $serverIP='app.cloopen.com';
    //请求端口，生产环境和沙盒环境一致
    $serverPort='8883';
    //REST版本号，在官网文档REST介绍中获得。
    $softVersion='2013-12-26';
    // return 'TP5前台主页';
    //主帐号,对应开官网发者主账号下的 ACCOUNT SID
    $accountSid= '8a216da86077dcd001609aa56dd81307';
    //主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
    $accountToken= '4baa9adcd259467189178f0156dd5fff';
    //应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
    //在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
    $appId='8a216da86077dcd001609aa56e3d130e';
    //请求地址
    //沙盒环境（用于应用开发调试）：sandboxapp.cloopen.com
    //生产环境（用户应用上线使用）：app.cloopen.com
    $serverIP='app.cloopen.com';
    //请求端口，生产环境和沙盒环境一致
    $serverPort='8883';
    //REST版本号，在官网文档REST介绍中获得。
    $softVersion='2013-12-26';
    // global $accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion;
    $rest = new Rest($serverIP,$serverPort,$softVersion);
    $rest->setAccount($accountSid,$accountToken);
    $rest->setAppId($appId);
    // 发送模板短信
    // echo "Sending TemplateSMS to $to <br/>";
    $data = $rest->sendTemplateSMS($to,$datas,$tempId);

    // var_dump($data);
    return $data;
    die;


    if($result == NULL ) {
        // echo "result error!";
        // break;
    }
    if($result->statusCode!=0) {
        // echo "error code :" . $result->statusCode . "<br>";
        // echo "error msg :" . $result->statusMsg . "<br>";
        //TODO 添加错误处理逻辑
    }else{
        // echo "Sendind TemplateSMS success!<br/>";
        // 获取返回信息
        $smsmessage = $result->TemplateSMS;
        // echo "dateCreated:".$smsmessage->dateCreated."<br/>";
        // echo "smsMessageSid:".$smsmessage->smsMessageSid."<br/>";
        //TODO 添加成功处理逻辑
    }

}




//发送邮箱验证码

function sendMail($usermail)
{
    $mail = new PhpMailer(); //建立邮件发送类
    $mail->CharSet = "UTF-8";
    $address ="290468335@qq.com";
    $mail->IsSMTP(); // 使用SMTP方式发送
    $mail->Host = "smtp.qq.com"; // 您的企业邮局域名
    $mail->SMTPAuth = true; // 启用SMTP验证功能
    $mail->Username = "290468335@qq.com"; // 邮局用户名(请填写完整的email地址)
    $mail->Password = "ngmgjxdzfrstcabg"; // 邮局密码
    $mail->Port=25;
    $mail->From = "290468335@qq.com"; //邮件发送者email地址
    $mail->FromName = "波课";
    $mail->AddAddress($usermail, "title");//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
    //$mail->AddReplyTo("", "");

    //$mail->AddAttachment("/var/tmp/file.tar.gz"); // 添加附件
    $mail->IsHTML(true); // set email format to HTML //是否使用HTML格式

    $mail->Subject = "您的验证码是:"; //邮件标题
    $mail->Body = "895652"; //邮件内容，上面设置HTML，则可以是HTML

    if(!$mail->Send())
    {
        // echo "邮件发送失败. <p>";
        // echo "错误原因: " . $mail->ErrorInfo;
        return false;
        exit;
    }else{

        // echo '邮箱发送成功';
        return '邮箱发送成功';
    }

}
