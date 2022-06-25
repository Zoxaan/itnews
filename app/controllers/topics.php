<?php
include ('../../app/database/conect.php');


if ($_POST['action']=="createTopics"){
    $nameTopic = $_POST['title'];
    $content = $_POST['content'];



    if ($nameTopic === "" || $content=== "" ){
        $message[] = 'Нужно заполнить все поля';
    }elseif(mb_strlen($nameTopic,'UTF-8') <8)  {
        $message[] = 'Короткое название категории';
    }elseif (mb_strlen($content,"UTF-8") <5){
        $message[] = 'Короткой описание';
    }

 if (!empty($message)){
        $error_msg = ["key"=>"errpr","msg"=>$message];
        echo json_encode($error_msg);
    }else{
        $success_msg = ["key"=>"compl","msg"=>"Категория успешно создана"];
        $topicsadd = $dbh->prepare("INSERT INTO categories (name,dics) VALUES (:name , :content)");
        $topicsadd->execute([
            "name" => $nameTopic,
            "content"=>$content,
        ]);
        echo json_encode($success_msg);
    }







}

