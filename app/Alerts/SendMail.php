<?php
namespace App\Alerts;
use App\Helpers\Mailer;

class SendMail{
    protected $user;
    protected $mail;

    public function __construct($user)
    {
        $this->user = $user;
        $this->mail = new Mailer;
    }

    public function now()
    {
        $this->mail->setHeader($this->user->name);
        $this->mail->setContent("This a test email".rand(0,10000000000000));
        $email = $this->mail->send($this->user->email);
        if($email){
            return $email;
        }else{
            dd($email);
        }
    }


}