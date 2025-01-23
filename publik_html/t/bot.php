<?php

#=====[CONFIG]=====#
$token = "";  
$remotehost = "https://github.com/porofewornima/selfofnima/tree/main/publik_html/t"; 
$admin = ""; 
#=================#

#=================#
echo "True";
ob_start();
define('API_KEY',$token);
#=============
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
#
#
#
#
#
#
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$from_id = $message->from->id;
//---
$data = $update->callback_query->data;
$chatid = $update->callback_query->message->chat->id;
$firstcall = $update->callback_query->message->chat->first_name;
$usercall = $update->callback_query->message->chat->username;
$messageid = $update->callback_query->message->message_id;
//---
$message_id = $update->callback_query->message->message_id;
$messag = $update->message;
$text = $message->text;
$cmd = file_get_contents("data/$chat_id/cmd.txt");
$forward_chat_username = $update->message->forward_from_chat->username;
$forward_chat_msg_id = $update->message->forward_from_message_id;
$tc = $message->chat->type;
$reply = $update->message->reply_to_message;
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
@$matin = file_get_contents("data/$chat_id/matin.txt");
@mkdir("data/$chat_id");
@mkdir("@rexweb");
@mkdir("@King_movie7");
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$from_id = $message->from->id;
#=============
if(!is_dir("settings")){
    mkdir("settings");
    file_put_contents("settings/alwaysonline.txt","no");
    file_put_contents("settings/showtimebio.txt","no");
    file_put_contents("settings/showtimename.txt","no");
    file_put_contents("settings/botstatus.txt","no");
    file_put_contents("settings/autobiochange.txt","no");
    file_put_contents("settings/autonamechange.txt","no");
}
#=============
function sendalert($thealert){
    if($thealert = "truesetings"){ $thealert = "✅تنظیمات مورد نظر اعمال شد."; }
        bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => $thealert,
            'show_alert' => false
        ]);
}
function detectCommand($thecommand){
    if($text == $thecommand){
        return true;
    }else{
     return false;   
    }
}
function onCommand($thecmd){
    $checkthat = file_get_contents("data/$chat_id/cmd.txt");
    if($checkthat == $thecmd){ return true; }else{
        return false;
    }
}
function setCommand($thecmd){
    return file_put_contents("data/$chat_id/cmd.txt", $thecmd);
}
function sendmessage($chat_id, $text)
{
    bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => $text,
        'parse_mode' => "HTML"
    ]);
}

function deletemessage($chat_id, $message_id)
{
    bot('deletemessage', [
        'chat_id' => $chat_id,
        'message_id' => $message_id,
    ]);
}

function sendaction($chat_id, $action)
{
    bot('sendchataction', [
        'chat_id' => $chat_id,
        'action' => $action
    ]);
}

function Forward($KojaShe, $AzKoja, $KodomMSG)
{
    bot('ForwardMessage', [
        'chat_id' => $KojaShe,
        'from_chat_id' => $AzKoja,
        'message_id' => $KodomMSG
    ]);
}

function sendphoto($chat_id, $photo, $action)
{
    bot('sendphoto', [
        'chat_id' => $chat_id,
        'photo' => $photo,
        'action' => $action
    ]);
}

function objectToArrays($object)
{
    if (!is_object($object) && !is_array($object)) {
        return $object;
    }
    elseif (is_object($object)) {
        $object = get_object_vars($object);
    }
    return array_map("objectToArrays", $object);
}function editMessagetext($chat_id,$message_id,$text,$parse_mode,$disable_web_page_preview,$keyboard){
  bot('editMessagetext',[
    'chat_id'=>$chat_id,
 'message_id'=>$message_id,
    'text'=>$text,
    'parse_mode'=>$parse_mode,
 'disable_web_page_preview'=>$disable_web_page_preview,
    'reply_markup'=>$keyboard
 ]);
 }
function pinChatMessage($chat_id){
bot('pinChatMessage',[
'chat_id'=>$chat_id,
]);
}
if(preg_match('/^\/([Ss]tart)(.*)/',$text) or ($text == "🔙بازگشت")){
    if($chat_id == $admin){
        file_put_contents("data/$chat_id/cmd.txt","none");
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
	📍با سلام ادمین گرامی 
✅به ربات مدیریت حساب کاربری خود خوش آمدید.
	",
        'reply_to_message_id'=>$update->message->message_id,
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
[['text'=>"⚙️تنظیمات"]],
[['text'=>"🔧مدیریت اکانت"],['text'=>"🛠وضعیت "]],
[['text'=>"▪️بررسی اتصال"],['text'=>"⚙️کانال رکس وب⚙️"]],
]
])
]);
}else{
bot('sendMessage', [
'chat_id' => $chat_id,
'text' => "برای ساخت همچین رباتی در کانال ما عضو شوید♥",
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🛰کانال اصلی ما🛰",'url'=>"http://t.me/rexweb"]],
[['text'=>"↩️رکس وب↩️",'url'=>"https://rexweb.info/"]],
]
])
]);
}
}
elseif($text == "⚙️کانال رکس وب⚙️"){
bot('sendMessage', [
'chat_id' => $chat_id,
'text' => "برای ساخت همچین رباتی در کانال ما عضو شوید♥",
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🛰کانال اصلی ما🛰",'url'=>"http://t.me/rexweb"]],
[['text'=>"↩️رکس وب↩️",'url'=>"https://rexweb.info/"]],
]
])
]);
}
 
	elseif($text == "⚙️تنظیمات"){
	        if($chat_id == $admin){
	            $alwaysonline = file_get_contents("settings/alwaysonline.txt");
	            $showtimebio = file_get_contents("settings/showtimebio.txt");
	            $showtimename = file_get_contents("settings/showtimename.txt");
	            $botstatus = file_get_contents("settings/botstatus.txt");
	            $autobiochange = file_get_contents("settings/autobiochange.txt");
	            $autonamechange = file_get_contents("settings/autonamechange.txt");
	            if($alwaysonline == "no"){ $alwaysonline = "❌"; }else{ if($alwaysonline == "yes"){ $alwaysonline = "✅"; } }
	            if($showtimebio == "no"){ $showtimebio = "❌"; }else{ if($showtimebio == "yes"){ $showtimebio = "✅"; } }
	            if($showtimename == "no"){ $showtimename = "❌"; }else{ if($showtimename == "yes"){ $showtimename = "✅"; } }
	            if($botstatus == "no"){ $botstatus = "❌"; }else{ if($botstatus == "yes"){ $botstatus = "✅"; } }
	            if($autobiochange == "no"){ $autobiochange = "❌"; }else{ if($autobiochange == "yes"){ $autobiochange = "✅"; } }
	            if($autonamechange == "no"){ $autonamechange = "❌"; }else{ if($autonamechange == "yes"){ $autonamechange = "✅"; } }
	bot('sendmessage',[
              'chat_id'=>$chat_id,
             'text'=>"
⚙️به بخش تنظیمات خوش آمدید !
💡در این قسمت میتوانید تنظیمات خود را روی اکانت خودتون اعمال کنید.
             ",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
                    
 [
['text'=>"🔋آنلاین بودن",'callback_data'=>'text'],['text'=>"$alwaysonline",'callback_data'=>'lockonline']
],
[
['text'=>"⏰نمایش ساعت در بیو",'callback_data'=>'text'],['text'=>"$showtimebio",'callback_data'=>'locktimebio']
],
[
['text'=>"🕰نمایش ساعت در نام",'callback_data'=>'text'],['text'=>"$showtimename",'callback_data'=>'locktimename']
],
  [
 ['text'=>"💡تغییر خودکار بیو",'callback_data'=>'text'],['text'=>"$autobiochange",'callback_data'=>'lockautobio']
 ],
   [
 ['text'=>"🔮تغییر خودکار نام",'callback_data'=>'text'],['text'=>"$autonamechange",'callback_data'=>'lockautoname']
 ],
  [
 ['text'=>"🤖 وضعیت ربات",'callback_data'=>'text'],['text'=>"$botstatus",'callback_data'=>'lockbotstatus']
 ],
				   ]
             ])
         ]);
	}else{
	    sendmessage($chat_id,"این ربات شخصی است و شما دسترسی استفاده از این ربات را ندارید.");
	}
	}
	elseif($data == "lockonline"){
	    	        if($chatid == $admin){
	    	            #sendalert("truesetings");
	    	            $alwaysonline = file_get_contents("settings/alwaysonline.txt");
	    	            if($alwaysonline == "no"){
	    	                $alwaysonline = "✅";
	    	            file_put_contents("settings/alwaysonline.txt","yes");
	    	            }else{
	    	                if($alwaysonline == "yes"){
	    	                    $alwaysonline = "❌";
	    	                    file_put_contents("settings/alwaysonline.txt","no");
	    	                }
	    	            }
	            $showtimebio = file_get_contents("settings/showtimebio.txt");
	            $showtimename = file_get_contents("settings/showtimename.txt");
	            $botstatus = file_get_contents("settings/botstatus.txt");
	            $autobiochange = file_get_contents("settings/autobiochange.txt");
	            $autonamechange = file_get_contents("settings/autonamechange.txt");
	            if($alwaysonline == "no"){ $alwaysonline = "❌"; }else{ if($alwaysonline == "yes"){ $alwaysonline = "✅"; } }
	            if($showtimebio == "no"){ $showtimebio = "❌"; }else{ if($showtimebio == "yes"){ $showtimebio = "✅"; } }
	            if($showtimename == "no"){ $showtimename = "❌"; }else{ if($showtimename == "yes"){ $showtimename = "✅"; } }
	            if($botstatus == "no"){ $botstatus = "❌"; }else{ if($botstatus == "yes"){ $botstatus = "✅"; } }
	            if($autobiochange == "no"){ $autobiochange = "❌"; }else{ if($autobiochange == "yes"){ $autobiochange = "✅"; } }
	            if($autonamechange == "no"){ $autonamechange = "❌"; }else{ if($autonamechange == "yes"){ $autonamechange = "✅"; } }
	            bot('editmessagetext',[
              'chat_id'=>$chatid,
              'message_id'=>$messageid,
             'text'=>"✅عملیات مورد نظر انجام گردید.
🔁در حال ذخیره سازی...",
         ]);
         sleep(0.5);
	bot('editmessagetext',[
              'chat_id'=>$chatid,
              'message_id'=>$messageid,
             'text'=>"
⚙️به بخش تنظیمات خوش آمدید !
💡در این قسمت میتوانید تنظیمات خود را روی اکانت خودتون اعمال کنید.
             ",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
                    
 [
['text'=>"🔋آنلاین بودن",'callback_data'=>'text'],['text'=>"$alwaysonline",'callback_data'=>'lockonline']
],
[
['text'=>"⏰نمایش ساعت در بیو",'callback_data'=>'text'],['text'=>"$showtimebio",'callback_data'=>'locktimebio']
],
[
['text'=>"🕰نمایش ساعت در نام",'callback_data'=>'text'],['text'=>"$showtimename",'callback_data'=>'locktimename']
],
  [
 ['text'=>"💡تغییر خودکار بیو",'callback_data'=>'text'],['text'=>"$autobiochange",'callback_data'=>'lockautobio']
 ],
   [
 ['text'=>"🔮تغییر خودکار نام",'callback_data'=>'text'],['text'=>"$autonamechange",'callback_data'=>'lockautoname']
 ],
  [
 ['text'=>"🤖 وضعیت ربات",'callback_data'=>'text'],['text'=>"$botstatus",'callback_data'=>'lockbotstatus']
 ],
				   ]
             ])
         ]);
	}else{
	    sendmessage($chatid,"این ربات شخصی است و شما دسترسی استفاده از این ربات را ندارید.");
	}
	}
	elseif($data == "locktimebio"){
	    	        if($chatid == $admin){
	    	            #sendalert("truesetings");
	    	            $autobiochange = file_get_contents("settings/autobiochange.txt");
	    	            $showtimebio = file_get_contents("settings/showtimebio.txt");
	    	            if($showtimebio == "no"){
	    	                $autobiochange = "✅";
	    	                $showtimebio = "✅";
	    	            file_put_contents("settings/showtimebio.txt","yes");
	    	            file_put_contents("settings/autobiochange.txt","yes");
	    	            }else{
	    	                if($showtimebio == "yes"){
	    	                    $showtimebio = "❌";
	    	                    file_put_contents("settings/showtimebio.txt","no");
	    	                }
	    	            }
	            $alwaysonline = file_get_contents("settings/alwaysonline.txt");
	            $showtimename = file_get_contents("settings/showtimename.txt");
	            $botstatus = file_get_contents("settings/botstatus.txt");
	            $autonamechange = file_get_contents("settings/autonamechange.txt");
	            if($alwaysonline == "no"){ $alwaysonline = "❌"; }else{ if($alwaysonline == "yes"){ $alwaysonline = "✅"; } }
	            if($showtimebio == "no"){ $showtimebio = "❌"; }else{ if($showtimebio == "yes"){ $showtimebio = "✅"; } }
	            if($showtimename == "no"){ $showtimename = "❌"; }else{ if($showtimename == "yes"){ $showtimename = "✅"; } }
	            if($botstatus == "no"){ $botstatus = "❌"; }else{ if($botstatus == "yes"){ $botstatus = "✅"; } }
	            if($autobiochange == "no"){ $autobiochange = "❌"; }else{ if($autobiochange == "yes"){ $autobiochange = "✅"; } }
	            if($autonamechange == "no"){ $autonamechange = "❌"; }else{ if($autonamechange == "yes"){ $autonamechange = "✅"; } }
	            bot('editmessagetext',[
              'chat_id'=>$chatid,
              'message_id'=>$messageid,
             'text'=>"✅عملیات مورد نظر انجام گردید.
🔁در حال ذخیره سازی...",
         ]);
         sleep(0.5);
	bot('editmessagetext',[
              'chat_id'=>$chatid,
              'message_id'=>$messageid,
             'text'=>"
⚙️به بخش تنظیمات خوش آمدید !
💡در این قسمت میتوانید تنظیمات خود را روی اکانت خودتون اعمال کنید.
             ",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
                    
 [
['text'=>"🔋آنلاین بودن",'callback_data'=>'text'],['text'=>"$alwaysonline",'callback_data'=>'lockonline']
],
[
['text'=>"⏰نمایش ساعت در بیو",'callback_data'=>'text'],['text'=>"$showtimebio",'callback_data'=>'locktimebio']
],
[
['text'=>"🕰نمایش ساعت در نام",'callback_data'=>'text'],['text'=>"$showtimename",'callback_data'=>'locktimename']
],
  [
 ['text'=>"💡تغییر خودکار بیو",'callback_data'=>'text'],['text'=>"$autobiochange",'callback_data'=>'lockautobio']
 ],
   [
 ['text'=>"🔮تغییر خودکار نام",'callback_data'=>'text'],['text'=>"$autonamechange",'callback_data'=>'lockautoname']
 ],
  [
 ['text'=>"🤖 وضعیت ربات",'callback_data'=>'text'],['text'=>"$botstatus",'callback_data'=>'lockbotstatus']
 ],
				   ]
             ])
         ]);
	}else{
	    sendmessage($chatid,"این ربات شخصی است و شما دسترسی استفاده از این ربات را ندارید.");
	}
	}
		elseif($data == "locktimename"){
	    	        if($chatid == $admin){
	    	            #sendalert("truesetings");
	    	            $autonamechange = file_get_contents("settings/autonamechange.txt");
	    	            $showtimename = file_get_contents("settings/showtimename.txt");
	    	            if($showtimename == "no"){
	    	                if($autonamechange == "yes"){
	    	                $showtimename = "✅";
	    	                $autonamechange = "✅";
	    	            file_put_contents("settings/showtimename.txt","yes");
	    	                }else{
	    	                   file_put_contents("settings/showtimename.txt","yes");
	    	                   file_put_contents("settings/autonamechange.txt","yes");
	    	                   $showtimename = "✅";
	    	                $autonamechange = "✅";
	    	                }
	    	            }else{
	    	                if($showtimename == "yes"){
	    	                    $showtimename = "❌";
	    	                    file_put_contents("settings/showtimename.txt","no");
	    	                }
	    	            }
	    	    $alwaysonline = file_get_contents("settings/alwaysonline.txt");
	            $showtimebio = file_get_contents("settings/showtimebio.txt");
	            $botstatus = file_get_contents("settings/botstatus.txt");
	            $autobiochange = file_get_contents("settings/autobiochange.txt");
	            if($alwaysonline == "no"){ $alwaysonline = "❌"; }else{ if($alwaysonline == "yes"){ $alwaysonline = "✅"; } }
	            if($showtimebio == "no"){ $showtimebio = "❌"; }else{ if($showtimebio == "yes"){ $showtimebio = "✅"; } }
	            if($showtimename == "no"){ $showtimename = "❌"; }else{ if($showtimename == "yes"){ $showtimename = "✅"; } }
	            if($botstatus == "no"){ $botstatus = "❌"; }else{ if($botstatus == "yes"){ $botstatus = "✅"; } }
	            if($autobiochange == "no"){ $autobiochange = "❌"; }else{ if($autobiochange == "yes"){ $autobiochange = "✅"; } }
	            if($autonamechange == "no"){ $autonamechange = "❌"; }else{ if($autonamechange == "yes"){ $autonamechange = "✅"; } }
	            bot('editmessagetext',[
              'chat_id'=>$chatid,
              'message_id'=>$messageid,
             'text'=>"✅عملیات مورد نظر انجام گردید.
🔁در حال ذخیره سازی...",
         ]);
         sleep(0.5);
	bot('editmessagetext',[
              'chat_id'=>$chatid,
              'message_id'=>$messageid,
             'text'=>"
⚙️به بخش تنظیمات خوش آمدید !
💡در این قسمت میتوانید تنظیمات خود را روی اکانت خودتون اعمال کنید.
             ",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
                    
 [
['text'=>"🔋آنلاین بودن",'callback_data'=>'text'],['text'=>"$alwaysonline",'callback_data'=>'lockonline']
],
[
['text'=>"⏰نمایش ساعت در بیو",'callback_data'=>'text'],['text'=>"$showtimebio",'callback_data'=>'locktimebio']
],
[
['text'=>"🕰نمایش ساعت در نام",'callback_data'=>'text'],['text'=>"$showtimename",'callback_data'=>'locktimename']
],
  [
 ['text'=>"💡تغییر خودکار بیو",'callback_data'=>'text'],['text'=>"$autobiochange",'callback_data'=>'lockautobio']
 ],
   [
 ['text'=>"🔮تغییر خودکار نام",'callback_data'=>'text'],['text'=>"$autonamechange",'callback_data'=>'lockautoname']
 ],
  [
 ['text'=>"🤖 وضعیت ربات",'callback_data'=>'text'],['text'=>"$botstatus",'callback_data'=>'lockbotstatus']
 ],
				   ]
             ])
         ]);
	}else{
	    sendmessage($chatid,"این ربات شخصی است و شما دسترسی استفاده از این ربات را ندارید.");
	}
	}
elseif($data == "lockautobio"){
	    	        if($chatid == $admin){
	    	            #sendalert("truesetings");
	    	            $showtimebio = file_get_contents("settings/showtimebio.txt");
	    	            $autobiochange = file_get_contents("settings/autobiochange.txt");
	    	            if($autobiochange == "no"){
	    	                $autobiochange = "✅";
	    	            file_put_contents("settings/autobiochange.txt","yes");
	    	            }else{
	    	                if($autobiochange == "yes"){
	    	                    $autobiochange = "❌";
	    	                    $showtimebio = "❌";
	    	                    file_put_contents("settings/autobiochange.txt","no");
	    	                    file_put_contents("settings/showtimebio.txt","no");
	    	                }
	    	            }
	    	    $showtimename = file_get_contents("settings/showtimename.txt");
	    	    $alwaysonline = file_get_contents("settings/alwaysonline.txt");
	            $botstatus = file_get_contents("settings/botstatus.txt");
	            $autonamechange = file_get_contents("settings/autonamechange.txt");
	            if($alwaysonline == "no"){ $alwaysonline = "❌"; }else{ if($alwaysonline == "yes"){ $alwaysonline = "✅"; } }
	            if($showtimebio == "no"){ $showtimebio = "❌"; }else{ if($showtimebio == "yes"){ $showtimebio = "✅"; } }
	            if($showtimename == "no"){ $showtimename = "❌"; }else{ if($showtimename == "yes"){ $showtimename = "✅"; } }
	            if($botstatus == "no"){ $botstatus = "❌"; }else{ if($botstatus == "yes"){ $botstatus = "✅"; } }
	            if($autobiochange == "no"){ $autobiochange = "❌"; }else{ if($autobiochange == "yes"){ $autobiochange = "✅"; } }
	            if($autonamechange == "no"){ $autonamechange = "❌"; }else{ if($autonamechange == "yes"){ $autonamechange = "✅"; } }
	            bot('editmessagetext',[
              'chat_id'=>$chatid,
              'message_id'=>$messageid,
             'text'=>"✅عملیات مورد نظر انجام گردید.
🔁در حال ذخیره سازی...",
         ]);
         sleep(0.5);
	bot('editmessagetext',[
              'chat_id'=>$chatid,
              'message_id'=>$messageid,
             'text'=>"
⚙️به بخش تنظیمات خوش آمدید !
💡در این قسمت میتوانید تنظیمات خود را روی اکانت خودتون اعمال کنید.
             ",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
                    
 [
['text'=>"🔋آنلاین بودن",'callback_data'=>'text'],['text'=>"$alwaysonline",'callback_data'=>'lockonline']
],
[
['text'=>"⏰نمایش ساعت در بیو",'callback_data'=>'text'],['text'=>"$showtimebio",'callback_data'=>'locktimebio']
],
[
['text'=>"🕰نمایش ساعت در نام",'callback_data'=>'text'],['text'=>"$showtimename",'callback_data'=>'locktimename']
],
  [
 ['text'=>"💡تغییر خودکار بیو",'callback_data'=>'text'],['text'=>"$autobiochange",'callback_data'=>'lockautobio']
 ],
   [
 ['text'=>"🔮تغییر خودکار نام",'callback_data'=>'text'],['text'=>"$autonamechange",'callback_data'=>'lockautoname']
 ],
  [
 ['text'=>"🤖 وضعیت ربات",'callback_data'=>'text'],['text'=>"$botstatus",'callback_data'=>'lockbotstatus']
 ],
				   ]
             ])
         ]);
	}else{
	    sendmessage($chatid,"این ربات شخصی است و شما دسترسی استفاده از این ربات را ندارید.");
	}
	}
elseif($data == "lockautoname"){
	    	        if($chatid == $admin){
	    	            #sendalert("truesetings");
	    	            $showtimename = file_get_contents("settings/showtimename.txt");
	    	            $autonamechange = file_get_contents("settings/autonamechange.txt");
	    	            if($autonamechange == "no"){
	    	                $autonamechange = "✅";
	    	            file_put_contents("settings/autonamechange.txt","yes");
	    	            }else{
	    	                if($autonamechange == "yes"){
	    	                    $autonamechange = "❌";
	    	                    $showtimename = "❌";
	    	                    file_put_contents("settings/autonamechange.txt","no");
	    	                    file_put_contents("settings/showtimename.txt","no");
	    	                }
	    	            }
	    	            $showtimebio = file_get_contents("settings/showtimebio.txt");
	    	   $autobiochange = file_get_contents("settings/autobiochange.txt");
	    	    $alwaysonline = file_get_contents("settings/alwaysonline.txt");
	            $botstatus = file_get_contents("settings/botstatus.txt");
	            if($alwaysonline == "no"){ $alwaysonline = "❌"; }else{ if($alwaysonline == "yes"){ $alwaysonline = "✅"; } }
	            if($showtimebio == "no"){ $showtimebio = "❌"; }else{ if($showtimebio == "yes"){ $showtimebio = "✅"; } }
	            if($showtimename == "no"){ $showtimename = "❌"; }else{ if($showtimename == "yes"){ $showtimename = "✅"; } }
	            if($botstatus == "no"){ $botstatus = "❌"; }else{ if($botstatus == "yes"){ $botstatus = "✅"; } }
	            if($autobiochange == "no"){ $autobiochange = "❌"; }else{ if($autobiochange == "yes"){ $autobiochange = "✅"; } }
	            if($autonamechange == "no"){ $autonamechange = "❌"; }else{ if($autonamechange == "yes"){ $autonamechange = "✅"; } }
	            bot('editmessagetext',[
              'chat_id'=>$chatid,
              'message_id'=>$messageid,
             'text'=>"✅عملیات مورد نظر انجام گردید.
🔁در حال ذخیره سازی...",
         ]);
         sleep(0.5);
	bot('editmessagetext',[
              'chat_id'=>$chatid,
              'message_id'=>$messageid,
             'text'=>"
⚙️به بخش تنظیمات خوش آمدید !
💡در این قسمت میتوانید تنظیمات خود را روی اکانت خودتون اعمال کنید.
             ",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
                    
 [
['text'=>"🔋آنلاین بودن",'callback_data'=>'text'],['text'=>"$alwaysonline",'callback_data'=>'lockonline']
],
[
['text'=>"⏰نمایش ساعت در بیو",'callback_data'=>'text'],['text'=>"$showtimebio",'callback_data'=>'locktimebio']
],
[
['text'=>"🕰نمایش ساعت در نام",'callback_data'=>'text'],['text'=>"$showtimename",'callback_data'=>'locktimename']
],
  [
 ['text'=>"💡تغییر خودکار بیو",'callback_data'=>'text'],['text'=>"$autobiochange",'callback_data'=>'lockautobio']
 ],
   [
 ['text'=>"🔮تغییر خودکار نام",'callback_data'=>'text'],['text'=>"$autonamechange",'callback_data'=>'lockautoname']
 ],
  [
 ['text'=>"🤖 وضعیت ربات",'callback_data'=>'text'],['text'=>"$botstatus",'callback_data'=>'lockbotstatus']
 ],
				   ]
             ])
         ]);
	}else{
	    sendmessage($chatid,"این ربات شخصی است و شما دسترسی استفاده از این ربات را ندارید.");
	}
	}
elseif($data == "lockbotstatus"){
	    	        if($chatid == $admin){
	    	            #sendalert("truesetings");
	    	            $botstatus = file_get_contents("settings/botstatus.txt");
	    	            if($botstatus == "no"){
	    	                $botstatus = "✅";
	    	            file_put_contents("settings/botstatus.txt","yes");
	    	            }else{
	    	                if($botstatus == "yes"){
	    	                    $botstatus = "❌";
	    	                    file_put_contents("settings/botstatus.txt","no");
	    	                }
	    	            }
	    	  $autonamechange = file_get_contents("settings/autonamechange.txt");
	    	   $autobiochange = file_get_contents("settings/autobiochange.txt");
	    	    $showtimename = file_get_contents("settings/showtimename.txt");
	    	    $alwaysonline = file_get_contents("settings/alwaysonline.txt");
	            $showtimebio = file_get_contents("settings/showtimebio.txt");
	            if($alwaysonline == "no"){ $alwaysonline = "❌"; }else{ if($alwaysonline == "yes"){ $alwaysonline = "✅"; } }
	            if($showtimebio == "no"){ $showtimebio = "❌"; }else{ if($showtimebio == "yes"){ $showtimebio = "✅"; } }
	            if($showtimename == "no"){ $showtimename = "❌"; }else{ if($showtimename == "yes"){ $showtimename = "✅"; } }
	            if($botstatus == "no"){ $botstatus = "❌"; }else{ if($botstatus == "yes"){ $botstatus = "✅"; } }
	            if($autobiochange == "no"){ $autobiochange = "❌"; }else{ if($autobiochange == "yes"){ $autobiochange = "✅"; } }
	            if($autonamechange == "no"){ $autonamechange = "❌"; }else{ if($autonamechange == "yes"){ $autonamechange = "✅"; } }
	            bot('editmessagetext',[
              'chat_id'=>$chatid,
              'message_id'=>$messageid,
             'text'=>"✅عملیات مورد نظر انجام گردید.
🔁در حال ذخیره سازی...",
         ]);
         sleep(0.5);
	bot('editmessagetext',[
              'chat_id'=>$chatid,
              'message_id'=>$messageid,
             'text'=>"
⚙️به بخش تنظیمات خوش آمدید !
💡در این قسمت میتوانید تنظیمات خود را روی اکانت خودتون اعمال کنید.
             ",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
                    
 [
['text'=>"🔋آنلاین بودن",'callback_data'=>'text'],['text'=>"$alwaysonline",'callback_data'=>'lockonline']
],
[
['text'=>"⏰نمایش ساعت در بیو",'callback_data'=>'text'],['text'=>"$showtimebio",'callback_data'=>'locktimebio']
],
[
['text'=>"🕰نمایش ساعت در نام",'callback_data'=>'text'],['text'=>"$showtimename",'callback_data'=>'locktimename']
],
  [
 ['text'=>"💡تغییر خودکار بیو",'callback_data'=>'text'],['text'=>"$autobiochange",'callback_data'=>'lockautobio']
 ],
   [
 ['text'=>"🔮تغییر خودکار نام",'callback_data'=>'text'],['text'=>"$autonamechange",'callback_data'=>'lockautoname']
 ],
  [
 ['text'=>"🤖 وضعیت ربات",'callback_data'=>'text'],['text'=>"$botstatus",'callback_data'=>'lockbotstatus']
 ],
				   ]
             ])
         ]);
	}else{
	    sendmessage($chatid,"این ربات شخصی است و شما دسترسی استفاده از این ربات را ندارید.");
	}
	}
	elseif($text == "🛠وضعیت"){
	    if($chat_id == $admin){
	        $botstatus = file_get_contents("settings/botstatus.txt");
	        $autonamechange = file_get_contents("settings/autonamechange.txt");
	    	   $autobiochange = file_get_contents("settings/autobiochange.txt");
	    	    $showtimename = file_get_contents("settings/showtimename.txt");
	    	    $alwaysonline = file_get_contents("settings/alwaysonline.txt");
	            $showtimebio = file_get_contents("settings/showtimebio.txt");
	            if($botstatus == "no"){
	                $botstatus = "🛑خاموش🛑";
	            }else{
	                $botstatus = "✳️روشن✳️";
	            }
	            $textsendkon = "📍وضعیت ربات مدیریت اکانت شما به شرح زیر میباشد :

⬛️وضعیت ربات : $botstatus

▪️آنلاین بودن خودکار : $alwaysonline
▪️نمایش ساعت در بیوگرافی : $showtimebio
▪️نمایش ساعت در نام : $showtimename
▪️تغییر خودکار بیوگرافی : $autobiochange
▪️تغییر خودکار نام : $autonamechange

☑️با استفاده از دکمه تنظیمات میتوانید موارد بالا را تغییر دهید و از بخش مدیریت اکانت میتوانید متن ها و تنظیمات ضروری مربوط به موارد بالا را تنظیم کنید.
🔺همچنین اگر تنظیماتی را تغییر دادید میتوانید با استفاده از دکمه بررسی اتصال، ربات نصب شده روی اکانت خود را بروزرسانی کنید.";
$textsendkon = str_replace("no", "🔹خاموش", $textsendkon);
$textsendkon = str_replace("yes", "🔸روشن", $textsendkon);
	        sendmessage($chat_id, $textsendkon);
	    }else{
	    sendmessage($chat_id,"این ربات شخصی است و شما دسترسی استفاده از این ربات را ندارید.");
	}  
	}
	elseif($text == "▪️بررسی اتصال"){
	   if($chat_id == $admin){
	       sendmessage($chat_id, "▪️درحال بررسی اتصال به اکانت شما....");
	       $checkingaccount = file_get_contents("$remotehost/api/index.php");
	       if($checkingaccount == "connected"){
	           $checkingaccount = "موفق آمیز";
	       }else{
	           file_put_contents("settings/botstatus.txt","no");
	           $checkingaccount = "ناموفق";
	       }
	       sendmessage($chat_id,"🔘اتصال به اکانت شما $checkingaccount بود.");
	}else{
	    sendmessage($chat_id,"این ربات شخصی است و شما دسترسی استفاده از این ربات را ندارید.");
	}  
	}
	if($text == "🔧مدیریت اکانت"){
	    if($chat_id == $admin){
	        	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
	🤖به بخش مدیریت اکانت خوش آمدید.
😎در اینجا میتوانید تنظیمات ضروری ربات را ثبت کنید.
	",
        'reply_to_message_id'=>$update->message->message_id,
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[['text'=>"💻تنظیم بیوگرافی"]],
	[['text'=>"💻تنظیم نام"]],
	[['text'=>"🔸وضعیت🔸"]],
	[['text'=>"🔙بازگشت"]],
	]
	])
	]);
	    }else{
	    sendmessage($chat_id,"این ربات شخصی است و شما دسترسی استفاده از این ربات را ندارید.");
	} 
	}
		elseif($text == "💻تنظیم بیوگرافی"){
	    if($chat_id == $admin){
	        file_put_contents("data/$chat_id/cmd.txt","setbiotext");
	        	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
	
👤به بخش تنظیم متن بیوگرافی خوش آمدید.
⬛️لطفا متنی که میخواهید برای بیوگرافی خود تنظیم کنید را ارسال کنید.
	",
        'reply_to_message_id'=>$update->message->message_id,
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[['text'=>"🔙بازگشت"]],
	]
	])
	]);
	$autobiochange = file_get_contents("settings/autobiochange.txt");
	if($autobiochange == "yes"){
	    sendmessage($chat_id,"
	    ❗️تذکر ❗️ تنظیمات تغییر خودکار بیوگرافی روشن است. درصورتی که این گزینه روشن باشد و شما اکنون بیوگرافی مورد نظر خود را ارسال کنید، اگر به اشتباهی بیوگرافی خود را تغییر بدهید ربات مجددا بیوگرافی شما را به همین بیوگرافی ای که الان در حال تنظیم آن هستید، تنظیم میکند.
	    ");
	}
	$showtimebio = file_get_contents("settings/showtimebio.txt");
	if($showtimebio == "yes"){
	    sendmessage($chat_id, "
	    ❗️هشدار❗️ تنظیمات نمایش ساعت در بیوگرافی روشن میباشد. اگر تمایل به نمایش ساعت یا تاریخ در بیوگرافی خود دارید، لطفا در متن ارسالی خود از متغیر های زیر استفاده کنید :
▪️به جای ساعت از [VAR_TIME] استفاده کنید.
▪️به جای تاریخ انگلیسی از [VAR_ENDATE] استفاده کنید.
🔺کلمات بالا بصورت خودکار جایگزین میشوند، درصورتی که تنظیمات نمایش بیوگرافی را خاموش کنید، ربات دیگر زمان را بر روی بیوگرافی شما بروز نمیکند.
	    ");
	}
	}else{
	    sendmessage($chat_id,"این ربات شخصی است و شما دسترسی استفاده از این ربات را ندارید.");
	} 
	}
	elseif($text !== "🔙بازگشت" && $cmd == "setbiotext"){
	    file_put_contents("data/$chat_id/cmd.txt","none");
	    file_put_contents("settings/biotext.txt",$text);
	    sendmessage($chat_id,"
	    ✔️متن با موفقیت تنظیم شد، تغییرات اعمال شده بین 10 الی 60 ثانیه طول میکشد تا روی اکانت شما نصب شود. درصورتی که میخواهید همین حالا تغییرات اعمال شده را مشاهده کنید، از دکمه بررسی اتصال استفاده کنید.
	    ");
	}
elseif($text == "💻تنظیم نام"){
	    if($chat_id == $admin){
	        file_put_contents("data/$chat_id/cmd.txt","setnmeext");
	        	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
		
👤به بخش تنظیم متن نام خوش آمدید.
🔷لطفا در ابتدا تایین کنید میخواهید متن را روی FirstName تنظیم کنید یا LastName را تنظیم کنید؟
⚠️توجه داشته باشید که باید یکی از گزینه ها را انتخاب کنید و درصورت تغییر، گزینه دیگری غیر فعال میشود.
	",
        'reply_to_message_id'=>$update->message->message_id,
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[['text'=>"First Name"],['text'=>"Last Name"]],
	[['text'=>"🔙بازگشت"]],
	]
	])
	]);
	}else{
	    sendmessage($chat_id,"این ربات شخصی است و شما دسترسی استفاده از این ربات را ندارید.");
	} 
	}
	elseif($text !== "🔙بازگشت" && $cmd == "setnmeext"){
	    $cansends = array("First Name","Last Name");
	    if(!in_array($text,$cansends)){
	        sendmessage($chat_id,"لطفا فقط از کیبورد زیر انتخاب کنید.");
	    }else{
	    file_put_contents("data/$chat_id/cmd.txt","setnmeext2");
	    if($text == "First Name"){
	        file_put_contents("settings/typenametext.txt","first");
	    }
	    if($text == "Last Name"){
	        file_put_contents("settings/typenametext.txt","last");
	    }
	        	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
✅بسیار خب شما تنظیمات نام خود را روی $text تنظیم کردید.
✔️حالا لطفا متنی که میخواهید تنظیم کنید را ارسال کنید.
	",
        'reply_to_message_id'=>$update->message->message_id,
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[['text'=>"🔙بازگشت"]],
	]
	])
	]);
	$autonamechange = file_get_contents("settings/autonamechange.txt");
  if($autonamechange == "yes"){
      sendmessage($chat_id,"
      ❗️تذکر ❗️ تنظیمات تغییر خودکار نام روشن است. درصورتی که این گزینه روشن باشد و شما اکنون متن نام مورد نظر خود را ارسال کنید، اگر به اشتباهی نام خود را تغییر بدهید ربات مجددا نام شما را به همین نام ای که الان در حال تنظیم آن هستید، تنظیم میکند.
      ");
  }
  $showtimename = file_get_contents("settings/showtimename.txt");
  if($showtimename == "yes"){
      sendmessage($chat_id, "
      ❗️هشدار❗️ تنظیمات نمایش ساعت در نام شما روشن میباشد. اگر تمایل به نمایش ساعت یا تاریخ در نام خود دارید، لطفا در متن ارسالی خود از متغیر های زیر استفاده کنید :
▪️به جای ساعت از [VAR_TIME] استفاده کنید.
▪️به جای تاریخ انگلیسی از [VAR_ENDATE] استفاده کنید.
🔺کلمات بالا بصورت خودکار جایگزین میشوند، درصورتی که تنظیمات نمایش زمان در نام را خاموش کنید، ربات دیگر زمان را بر روی نام شما بروز نمیکند.
      ");
  }
	}
	}
		elseif($text !== "🔙بازگشت" && $cmd == "setnmeext2"){
	    file_put_contents("data/$chat_id/cmd.txt","none");
	    file_put_contents("settings/nametext.txt",$text);
	    sendmessage($chat_id,"
	    ✔️متن با موفقیت تنظیم شد، تغییرات اعمال شده بین 10 الی 60 ثانیه طول میکشد تا روی اکانت شما نصب شود. درصورتی که میخواهید همین حالا تغییرات اعمال شده را مشاهده کنید، از دکمه بررسی اتصال استفاده کنید.
	    ");
	}
		elseif($text == "🔸وضعیت🔸"){
	    if($chat_id == $admin){
	        $botstatus = file_get_contents("settings/botstatus.txt");
	        $autonamechange = file_get_contents("settings/autonamechange.txt");
	    	   $autobiochange = file_get_contents("settings/autobiochange.txt");
	    	    $showtimename = file_get_contents("settings/showtimename.txt");
	    	    $alwaysonline = file_get_contents("settings/alwaysonline.txt");
	            $showtimebio = file_get_contents("settings/showtimebio.txt");
	            $typenametime = file_get_contents("settings/typenametext.txt");
	            $thenametext = file_get_contents("settings/nametext.txt");
	            $thebiotext = file_get_contents("settings/biotext.txt");
	            if($thenametext == null){ $thenametext == "تنظیم نشده"; }
	            if($typenametime == null){ $typenametime == "تنظیم نشده"; }
	            if($thebiotext == null){ $thebiotext == "تنظیم نشده"; }
	            if($botstatus == "no"){
	                $botstatus = "🛑خاموش🛑";
	            }else{
	                $botstatus = "✳️روشن✳️";
	            }
	            $textsendkon = "
	            📍اطلاعات بخش مدیریت اکانت شما به شرح زیر میباشد :

⬛️وضعیت ربات : $botstatus

▪️نمایش ساعت/تاریخ در نام :$showtimename
▪️نمایش ساعت/تاریخ در بیو : $showtimebio

▪️نوع تنظیم نام : $typenametime

▪️متن تنظیم شده برای نام :
$thenametext

▪️متن تنظیم شده برای بیو :
$thebiotext

❗️شما میتوانید با استفاده از گزینه های زیر و دکمه تنظیمات تمامی موارد بالا را تغییر دهید.
	            ";
$textsendkon = str_replace("no", "🔹خاموش", $textsendkon);
$textsendkon = str_replace("yes", "🔸روشن", $textsendkon);
	        sendmessage($chat_id, $textsendkon);
	    }else{
	    sendmessage($chat_id,"این ربات شخصی است و شما دسترسی استفاده از این ربات را ندارید.");
	}  
	}
unlink("error_log");

?>
