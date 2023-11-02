<?php
$id = intval($_GET['id']);
//1. Veritabanında böyle bir kullanıcı var mı
$c = $db->db->prepare("select * from users where id=?");
$c->execute(array($id));
$count = $c->rowCount();
if($count == 0){
    $returnArray['message'] = "Böyle Bir Kullanıcı Bulunmuyor";
    return;
}
$w = $db->db->prepare("select * from users where id=?");
$w->execute(array($id));
$result = $w->fetch(PDO::FETCH_ASSOC);
$returnArray['data'] = $result;
$returnArray['status'] = true;

//2. Varsa bilgileri yazdır