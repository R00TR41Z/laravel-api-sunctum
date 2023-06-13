# Simple API wich Laravel sunctum


## Anyone can test at 

- https://api.rootraiz.site/

### endpoints 

- /register
#### params
- email
- name
- password


- /login
#### params
- email
- password

### Those endpoints is protected by sunctum
- /user


- sendMail

- /bycredit

#### params
- salt = int



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
  touch database/database.sqlite
```
```shell
  php artisan migrate
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

- edit this file .env
```ini
APP_NAME="API learn"
APP_ENV=local
APP_KEY=base64:JD+OGs2idQQaXOSQUjGFQrpngmyce7co4gH7PHd9/bk=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=sqlite


BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=
MAIL_PORT=465
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=""
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

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
        $this->header = $header;
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
            $this->mail->Subject = "Hello ".$this->header;
            $this->mail->Body    = '<h1><b>'.$this->content.'</b></h1>';
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
