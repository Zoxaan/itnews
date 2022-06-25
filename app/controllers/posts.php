<?php
session_start();
include ('../../app/database/conect.php');
if($_POST["action"]=="createPosts"){
    $PostTitle = $_POST['title'];
    $PostContent = $_POST['content'];


    if ($PostContent == ""||$PostTitle == ""){
        $validate_msg[] = "Нужно заполнить все поля ";
    }elseif (mb_strlen($PostTitle,"UTF-8") < 7 ){
        $validate_msg[] = "Слишком короткое название поста ";
    }elseif(mb_strlen($PostContent,"UTF-8")<20){
     $validate_msg[] = "Короткое содержимое поста ";
    }

    if(!empty($validate_msg)){
        $error_msg = ["key"=>"error_msg","message"=>$validate_msg];
         echo json_encode($error_msg);



    }else{
        $error_msg = ["key"=>"success"];
        echo json_encode($error_msg);
       // $UserID = $dbh->prepare("SELECT * FROM users WHERE id = ");
        $postsinsert = $dbh->prepare("INSERT INTO posts (Title,content,user_id) VALUES (:name , :content,:userid)");
        $postsinsert->execute([
            "name" => $PostTitle,
            "content"=>$PostContent,
            "userid" => $_SESSION['id']
        ]);

    }




}
