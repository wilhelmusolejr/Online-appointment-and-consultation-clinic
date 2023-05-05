<?php 

require_once 'database.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once $path."api/phpmailer-api/src/Exception.php";
require_once $path."api/phpmailer-api/src/PHPMailer.php";
require_once $path."api/phpmailer-api/src/SMTP.php";

Class mail{
  public $mail;
  public $email_set;
  public $pass_set;

  public $receiver;
  public $subject;
  public $body;

  public $content;

  public $userData;

  public $head;
  public $footer;
  
  protected $db;

  function __construct() {
    $this -> db = new Database();
    $this -> email_set = 'sinobossmo@wmsu-dietitianconsult.online';
    $this -> pass_set = 'Qw09058222@!';

    $this -> head = "<!DOCTYPE html>
    <html>
      <head>
        <meta charset='UTF-8'>
        <title>My Email</title>
        <style>
          * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
          }
          
          body {
            font-family: poppins, sans-serif;
            font-size: 16px;
            line-height: 1.5;
            color: #333;
          }
          h1 {
            font-size: 24px;
            font-weight: bold;
          }
          p {
            margin-bottom: 10px;
          }
          a {
            color: #007bff;
            text-decoration: none;
          }
          a:hover {
            text-decoration: underline;
          }
          
          .container-message-parent {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            
            border: 1px solid black;
            border-radius: 10px;
          }
          
          .header { 
            margin-top: 10px;
            
            background-color: #0a331a;
            background-color: #277043;
            padding: 40px 0;
            
            border-top: 8px solid #0a331a;
            border-bottom: 8px solid #0a331a;
          }
          .header h1 {
            color: white;
            letter-spacing: 2px;
            text-transform: uppercase;
          }
          
          footer {
            padding: 15px 0; 
            background-color: #0a331a;
            background-color: #277043;
          }
          ul {
            width: 70%;
            margin: auto;
            
            list-style-type: none;
            
            display: flex;
            gap: 20px;
          }
          
          footer a {
            color: white !important;
            letter-spacing: 1px;
            
            text-transform: uppercase;
          }
          
          footer a:visited {
            color: white;
          }

          .note {
            text-align: center;
            padding-bottom: 50px;
          }
        </style>
      </head> 
      
      <body>
    <div class='header'>
      <h1 style='text-align:center'>WMSU Online Dietitian Clinic</h1>
    </div>";
    
    $this -> footer = "
    <div class='note'>
      <em>This is a system-generated e-mail. Please do not reply.</em>
    </div>
    
    <footer>
      <ul>
        <li><a href='#'>Home</a></li>
        <li><a href='#'>Consultation</a></li>
        <li><a href='#'>Monitoring</a></li>
        <li><a href='#'>Rnd</a></li>
        <li><a href='#'>About</a></li>
        <li><a href='#'>Contact</a></li>
      </ul>
    </footer>
  </body>
  </html>
  ";
    }

  function sendingEmail() {
    $mail = new PHPMailer(true);

    $mail -> isSMTP();
    $mail -> Host = 'smtp.hostinger.com';
    $mail -> Port = 587;
    $mail -> SMTPAuth = true;
    $mail -> SMTPSecure = 'tls';

    $mail -> Username = $this -> email_set;
    $mail -> Password = $this -> pass_set;

    $mail -> setFrom($this -> email_set, 'WMSU Dietitian');
    $mail -> addReplyTo('no-reply@wmsu-dietitianconsult.online');

    $mail -> addAddress($this -> receiver);
    $mail -> isHTML(true);

    $mail -> Subject = $this -> subject;
    $mail -> Body = $this -> body;

    $mail -> send();
  }

  function finalTemplate() {
    return $this -> head.$this -> content.$this -> footer;
  }

    
} 

?>