<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['smtp_host'] = 'ssl://smtp.gmail.com';
$config['smtp_port'] = 465;
$config['smtp_user'] = 'lucascavica@gmail.com';
$config['smtp_pass'] = ''; //senha
$config['protocol']  = 'smtp';
$config['validate']  = TRUE;
$config['mailtype']  = 'html';
$config['charset']   = 'utf-8';
$config['newline']   = "\r\n";