<?php

namespace App;


ini_set('display_errors',1);
ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '10M');
ini_set('max_input_time', 300);
ini_set('max_execution_time', 300);
error_reporting(E_ALL);

require_once __DIR__.'/vendor/autoload.php';
use App\Services\Router;

Router::start();


