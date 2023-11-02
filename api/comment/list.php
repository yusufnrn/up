<?php
$postId = mHelper::getIntegerVariable("postId");
$c = $db->db->prepare("select * from posts where id=?");
$c->execute(array($postId));
$count = $c->rowCount();

if ($count == 0){
    $returnArray['message'] = "Böyle Bir Post Bulunamadı";
    return;
}

$list = $db->db->prepare("select * from comments where postId=?");
$list->execute(array($postId));
$result = $list->fetchAll(PDO::FETCH_ASSOC);



/* Data Düzenleme */
$returnDataArray = [];
foreach ($result as $key => $value) {
    $user = $db->db->prepare("select * from users where id=?");
    $user->execute(array($value['userId']));
    $userInfo = $user->fetch(PDO::FETCH_ASSOC);
    $returnDataArray[$key]['id'] = $value['id'];
    $returnDataArray[$key]['postId'] = $value['postId'];
    $returnDataArray[$key]['user'] = $userInfo['name']." ".$userInfo['surname'];
    $returnDataArray[$key]['text'] = $value['text'];
    $returnDataArray[$key]['date'] = $value['date'];

    $returnArray['data'] = $returnDataArray;
}
