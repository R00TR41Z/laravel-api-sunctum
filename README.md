# Simple API wich Laravel sunctum

## how to test

```shell
  git clone https://github.com/R00TR41Z/laravel-api-sunctum/
  
```

```shell
  cd laravel-api-sunctum
  
```

```shell
  composer install
```

```shell
  php artisan serve
```
```shell
   php artisan tinker
   User::create([
    "name"=>"test",
    "username"=>"test",
    "email"=>"test@gmail.com",
    "pasword"=>bcrypt('password')
   ])
```


- edit this file app/Helper/Mailer.php

```php
<?php

namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer{
    protected $mail;
    protected $Host = "edit me";
    protected $Username = "edit me" ;
    protected $Password = "edit me";
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
            $this->mail->addReplyTo('edit me', 'Information');
        
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
```
