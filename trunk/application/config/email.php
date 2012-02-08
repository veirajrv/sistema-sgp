<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
/* 
| ------------------------------------------------------------------- 
| EMAIL CONFING ;extension=php_openssl.dll
| ------------------------------------------------------------------- 
| Configuration of outgoing mail server. 
| */  
$config['protocol']='smtp';  
$config['smtp_host']='ssl://smtp.googlemail.com';  
$config['smtp_port']='465';  
$config['smtp_timeout']='30';  
$config['smtp_user']='empresaslp21@gmail.com';  
$config['smtp_pass']='elp21carl';  
$config['charset']='utf-8';  
$config['newline']="\r\n";

/* End of file email.php */  
/* Location: ./system/application/config/email.php */  