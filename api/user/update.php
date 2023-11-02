<?php
if ($_POST){
    $id = mHelper::postIntegerVariable("id");
    $name = mHelper::postVariable("name");
    $surname = mHelper::postVariable("surname");
    $email = mHelper::postVariable("email");
    $password = mHelper::postVariable("password");
    $gender = mHelper::postIntegerVariable("gender");

    if ($name="" and $surname=="" and $email==""){
        $returnArray['message'] = "Lütfen Tüm Alanları Doldurunuz";
        return;
    }
    // Kullanıcı var mı kontrol
    $c = $db->db->prepare("select * from users where id =?");
    $c->execute(array($id));
    $count = $c->rowCount();
    if ($count == 0){
        $returnArray['message'] = "Böyle Bir Kullanıcı Yok";
        return;
    }
    // Email Var mı
    $cEmail = $db->db->prepare("select * from users where id !=? and email =?");
    $cEmail->execute(array($id,$email));
    $countEmail = $cEmail->rowCount();
    if ($countEmail !=0){
        $returnArray['message'] = "Bu Email Kullanımda";
    }
    // Şifre Var mı
    $w = $db->db->prepare("select * from users where id !=?");
    $w->execute(array($id));
    $result = $w->fetch(PDO::FETCH_ASSOC);
    if ($password ==""){
            $password = $result['password'];
    }else{
       $password = md5($result['password']);
    }
    // Update ET

    $update = $db->db->prepare("update users set name=?, surname=?, email=?, password=?, gender=? where id=?");
    $updateResult = $update->execute(array($name,$surname,$email,$password,$gender,$id));
    if ($updateResult){
        $returnArray['status'] = true;
        $returnArray['message'] = "Bilgiler Başarıyla Güncellendi";
    }else{
        $returnArray['message'] ="Bilgiler Güncellenemedi";
    }
}
