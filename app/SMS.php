<?php

namespace App;

class SMS
{
    public $template_id, $text, $phone, $reply;

    public function templet(String $template_id){
        $this->template_id = $template_id;
    }
    public function message(String $message){
        $this->text = $message;
    }
    public function phone(String $phone){
        $this->phone = $phone;
    }
    public function reply(){
        return $this->reply;
    }

    public function send(){
        $id = env('SMS_ID');
        $pwd = env('SMS_PWD');
        $ApiUrl = env('SMS_API_URL');

        $postdata = "Id=".$id."&Pwd=".urlencode($pwd)."&PhNo=".$this->phone."&text=".urlencode($this->text)."&TemplateID=".$this->template_id;              
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$ApiUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        ////
        curl_setopt($ch, CURLOPT_FAILONERROR, true);	
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        //curl_setopt($ch, CURLOPT_CAINFO, "/home/eastel1f/public_html/sungroupindia.in/app/includes/DSTRootCAX3.crt");

        ////

        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $resp=curl_exec($ch);
        if (curl_error($ch)) {
                $resp = curl_error($ch);
        }
        curl_close($ch);
        $this->reply =  $resp;
    }

}
