<?php
if ($_POST){
    $email = mHelper::postVariable("email");
    $password = mHelper::postVariable("password");

    if ($email=="" and $password==""){
        $returnArray['message'] = "Lütfen Gerekli Tüm Alanları Doldurunuz";
        return;
    }
    $c = $db->db->prepare("select * from users where email=?");
    $c->execute(array($email));
    $count = $c->rowCount();
    if ($count == 0) {
        $returnArray['message'] = "Bu Email Sistemde Kayıtlı Değil";
        return;
    }
    $w = $db->db->prepare("select * from users where email=?");
    $w->execute(array($email));
    $result = $w->fetch(PDO::FETCH_ASSOC);
    if ($result['password']!=md5($password)){
        $returnArray['message'] = "Hatalı Şifre";
        return;
    }
    $returnArray['status'] = true;
    $returnArray['userId'] = $result['id'];
    $returnArray['message'] = "Giriş Başarılı";
}