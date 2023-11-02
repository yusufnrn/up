<?php
$category_id= mHelper::getIntegerVariable("category_id");
$c = $db->db->prepare("select * from category where id=?");
$c->execute(array($category_id));
$count = $c->rowCount();
if ($count == 0){
    $returnArray['message'] = "Böyle Bir Kategori Yok";
    return;
}
$list = $db->db->prepare("select * from posts where categoryId=?");
$list->execute(array($category_id));
$result = $list->fetchAll(PDO::FETCH_ASSOC);
$returnArray['data'] = $result;