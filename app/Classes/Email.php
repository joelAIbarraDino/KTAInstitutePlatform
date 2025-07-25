<?php

namespace App\Classes;

use PHPMailer\PHPMailer\PHPMailer;
use Exception;

class Email{

    private $to;
    private $name;
    private $subject;
    private $html;
    private $attachments;
    
    public function __construct($to, $name, $subject, $html, $attachments = []){
        $this->to = $to;
        $this->name = $name;
        $this->subject = $subject;
        $this->html = $html;
        $this->attachments = $attachments;
    }

    public function sendEmail(){
        try {
            $mail = new PHPMailer();
            
            $mail->isSMTP();
            $mail->Host =  $this->isLocal()?$_ENV['LOCAL_EMAIL_HOST']:$_ENV['PRODUCTION_EMAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Port = $this->isLocal()?$_ENV['LOCAL_EMAIL_PORT']:$_ENV['PRODUCTION_EMAIL_PORT'];
            $mail->Username = $this->isLocal()?$_ENV['LOCAL_EMAIL_USER']:$_ENV['PRODUCTION_EMAIL_USER'];
            $mail->Password = $this->isLocal()?$_ENV['LOCAL_EMAIL_PASSWORD']:$_ENV['PRODUCTION_EMAIL_PASSWORD'];
            
            $mail->setFrom($_ENV['SENDER_MAIL'], 'KTA Institute');
            $mail->addAddress($this->to, $this->name);
            $mail->Subject = $this->subject;

            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            $mail->Body = $this->html;

            foreach($this->attachments as $item){
                if(is_string($item) && file_exists($item)){
                    $mail->addAttachment($item);
                }elseif(is_array($item) && isset($item['data'], $item['name'])){
                    $mail->addStringAttachment($item['data'], $item['name']);
                }
            }

        return $mail->send();
        } catch (Exception) {
            return false;
        }
    }

    private function isLocal():bool{
        return $_SERVER['HTTP_HOST'] == 'localhost:3000';
    }

}