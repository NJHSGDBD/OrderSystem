<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class MailController extends Controller
{
    public function mail(){
		Mail::raw('你好，我是PHP程序！', function ($message) {
		    $to = 'Jason_Zheng@webike-china.com';
		    $message ->to($to)->subject('纯文本信息邮件测试');
		});
    }
}
