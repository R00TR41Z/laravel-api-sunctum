<?php

namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer{
    protected $mail;
    protected $Host = "mail.rootraiz.site";
    protected $Username = "talk@rootraiz.site" ;
    protected $Password = "root@raiz6217";
    protected $Port = 465;
    protected $content;
    protected $header;
    
    public function __construct()
    {
        $this->mail = new PHPMailer(true);
    }

    public  function setHeader($header)
    {
        $this->$header = $header;
    }
    public function setContent($Content)
    {
        $this->content = $Content;
    }

    public function send($email,$attech = false,$path = '')
    {
        try {

            $this->mail->SMTPDebug = 0;
            $this->mail->isSMTP();
            $this->mail->Host       = $this->Host;
            $this->mail->SMTPAuth   = true;
            $this->mail->Username   = $this->Username;
            $this->mail->Password   = $this->Password;
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $this->mail->Port       = $this->Port;
        
            //Recipients
            $this->mail->setFrom($this->Username, 'RootRaiz talk');  
            $this->mail->addAddress($email);               
            $this->mail->addReplyTo('info@rootraiz.site', 'Information');
        
            if($attech){
                $this->mail->addAttachment($path);
            }
            $this->mail->isHTML(true);
            $this->mail->Subject = "<h1>".$this->header."</h1>";
            $this->mail->Body    = '<b>'.$this->content.'</b>';
            $this->mail->AltBody = $this->content;
        
            if($this->mail->send()){
                return true;
            }else{
                throw new Exception("Error o send email", 400);
            }
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}