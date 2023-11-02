<?php
header("Content-Type:application/json:charset=utf8");
require_once "config/database.php";
require_once 'api/Helper/mHelper.php';
$db=new Databse();

$returnArray = [];
$returnArray['status'] = false;

$mode = $_GET['mode'];
$process = $_GET['process'];

$path = 'api/'.$mode.'/'.$process.'.php';
if (file_exists($path)){
    require_once 'api/'.$mode.'/'.$process.'.php';
    echo json_encode($returnArray);
}else{
    die("Page Not Found");
}
