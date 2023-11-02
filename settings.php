<?php
ob_start();
session_start();
require_once 'nedmin/netting/class.crud.php';
$crud=Crud::init();


//$sql=Crud::read("settings");
//$row=$sql->fetchAll(PDO::FETCH_ASSOC);
    $sql=Crud::qSql("SELECT * FROM settings ");


    $row=$sql->FetchAll(PDO::FETCH_ASSOC);
foreach ($row as $key){
$settings[$key['settings_key']]=$key['settings_value'];
//echo $key['settings_key']."-->".$key['settings_value'];
}



?>