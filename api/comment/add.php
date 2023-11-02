<?php
if ($_POST){
    $userId = mHelper::postIntegerVariable("userId");
    $postId =mHelper::postIntegerVariable("postId");
    $text = mHelper::postVariable("text");

    if ($text == ""){
        $returnArray['message'] = "Text Alanı Boş Bırakılamaz";
        return;
    }
    $c = $db->db->prepare("select * from posts where id=?");
    $c->execute(array($postId));
    $count = $c->rowCount();

    if ($count == 0){
        $returnArray['message'] = "Böyle Bir Yazı Yok";
        return;
    }

    $date = date("Y-M-D");
    $insert = $db->db->prepare("insert into comments(userId,postId,text,date) values (?,?,?,?)");
    $insert->execute(array($userId,$postId,$text,$date));
    $insertResult = $insert->execute(array($userId,$postId,$text,$date));

    if ($insertResult){
        $returnArray['message'] = "Yorum Başarı ile Eklendi";
        $returnArray['status'] = true;
    }else{
        $returnArray['message'] = "Yorum Eklenemedi";
    }

}