<?php
if ($_POST) {
    $name = mHelper::postVariable("name");
    $surname = mHelper::postVariable("surname");
    $email = mHelper::postVariable("email");
    $password = mHelper::postVariable("password");
    $gender = mHelper::postIntegerVariable("gender"); // 0 erkek, 1 kadın
    if ($name != "" and $surname != "" and $email != "" and $password != "") {
        //1. Email kontrolü
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $returnArray['message'] = "Email Formatı Hatalı";
            return;
        }
        //2. Email veritabanında var mı?
        $c = $db->db->prepare("select * from users where email =?");
        $c->execute(array($email));
        $count = $c->rowCount();
        if ($count != 0) {
            $returnArray['message'] = "Bu Email Kullanımda.";
            return;
        }
        //3. Şifreyi şifrele
        $password = md5($password);
        //4. Bilgileri veritabanına ekle
        $date = date("Y-M-D");
        $eklemeSorgu = $db->db->prepare("insert into users(name,surname,email,password,gender,date) values (?,?,?,?,?,?)");
        $result = $eklemeSorgu->execute(array($name, $surname, $email, $password, $gender, $date));
        //5. Çıktıla
        if ($result) {
            $returnArray['status'] = true;
            $returnArray['message'] = "Kullanıcı Başarıyla Eklendi";
            } else {
                $returnArray['message'] = "Kullanıcı Ekleme Başarısız";
            }
    } else {
        $returnArray['status'] = false;
        $returnArray['message'] = "Lütfen Tüm Alanları Doldurunuz";
    }
} else {
    die("Post yok");
}
