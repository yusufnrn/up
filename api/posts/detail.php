<?php
$post_id= mHelper::getIntegerVariable('post_id');
$c = $db->db->prepare("select * from posts where id=?");
$c->execute(array($post_id));

$count = $c->rowCount();
if ($count == 0){
    $returnArray['message'] = "Böyle Bir Post Bulunamadı";
    return;
}

$data = $c->fetch(PDO::FETCH_ASSOC);
$returnArray['data'] = $data;
