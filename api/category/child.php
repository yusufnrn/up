<?php
$parent_id = mHelper::getIntegerVariable('parent_id');
$c = $db->db->prepare("select * from category where id=?");
$c->execute(array($parent_id));
$count = $c->rowCount();
if($count == 0){
    $returnArray['message'] = "Böyle Bir Kategori Yok";
    return;
}

$sorgu = $db->db->prepare("select * from category where parent_id=?");
$sorgu->execute(array($parent_id));
$result = $sorgu->fetchAll(PDO::FETCH_ASSOC);

$returnArray['status'] = true;
$returnArray['data'] = $result;



