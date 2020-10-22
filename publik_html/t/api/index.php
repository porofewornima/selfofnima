<?php

if (!file_exists('madeline.php')) {
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}
    include 'madeline.php';
    $MadelineProto = new \danog\MadelineProto\API('matin_me.madeline');
    $MadelineProto->async(true);
    $MadelineProto->loop(function () use ($MadelineProto) {
    yield $MadelineProto->start();
    date_default_timezone_set('Asia/Tehran');
    $time = date("H:i");
    $date = date("m/d/y");
try {
    if(file_get_contents("../settings/botstatus.txt") == "yes"){
        if(file_get_contents("../settings/autonamechange.txt") == "yes"){
            if(file_get_contents("../settings/showtimename.txt") == "yes"){
            $thenametext = str_replace("[VAR_TIME]",$time,file_get_contents("../settings/nametext.txt"));
            $thenametext = str_replace("[VAR_ENDATE]",$date,$thenametext);
            }
            if(file_get_contents("../settings/typenametext.txt") == "first"){
            yield $MadelineProto->account->updateProfile(['first_name' => $thenametext]); 
           }else{
               yield $MadelineProto->account->updateProfile(['last_name' => $thenametext]);
               }
               }
               if(file_get_contents("../settings/alwaysonline.txt") == "yes"){
                   yield $MadelineProto->account->updateStatus(['offline'=> false]);
                  }
                  if(file_get_contents("../settings/autobiochange.txt") == "yes"){
                  	if(file_get_contents("../settings/showtimebio.txt") == "yes"){
                  	$thebiotext = str_replace("[VAR_TIME]",$time,file_get_contents("../settings/biotext.txt"));
                  $thebiotext = str_replace("[VAR_ENDATE]",$date,$thebiotext);
                  yield $MadelineProto->account->updateProfile(['about' => $thebiotext]); 
                  }else{
                  	yield $MadelineProto->account->updateProfile(['about' => file_get_contents("../settings/biotext.txt")]);
                 }
                }
               }
    } catch (\danog\MadelineProto\RPCErrorException $e) {
    } catch (\danog\MadelineProto\Exception $e2) {
    }
    });
   echo "connected";

?>