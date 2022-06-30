<?php
session_start();
include ('../../app/database/conect.php');














if($_POST["action"]=="createPosts"){

    //
    $PostTitle = $_POST['title'];
    $PostContent = $_POST['content'];
    if ($_FILES['img']['name'] == ''){
        $imgName = "not_found.png";

    }else{
        $imgName = time() .'_'. $_FILES['img']['name'];
        $imgType = $_FILES['img']['type'];
        $imgtemp = $_FILES['img']['tmp_name'];
        $imgsize = $_FILES['img']['size'];

        $img_filder = "../../assets/images/" . $imgName;
        $result = move_uploaded_file($imgtemp, $img_filder);
    }


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


       // $UserID = $dbh->prepare("SELECT * FROM users WHERE id = ");
        $postsinsert = $dbh->prepare("INSERT INTO posts (Title,content,user_id,img) VALUES (:name , :content,:userid,:img)");
        $postsinsert->execute([
            "name" => $PostTitle,
            "content"=>$PostContent,
            "userid" => $_SESSION['id'],
            "img"=>$imgName,
        ]);
        $lastInsertID = $dbh->lastInsertId();
        $error_msg = ["key"=>"success","lastID"=>$lastInsertID];
        echo json_encode($error_msg);








    }



}








if ($_POST['action']=="loadPosts") {
    $query = $dbh->prepare("SELECT * FROM posts");
    $query->execute();
    $posts = $query->fetchAll(PDO::FETCH_ASSOC);


    foreach ($posts as $key => $post) {
        $number = $key + 1;
        $posts_echo =
            '<tr>
                    <td> ' . $number . '</td>
                     <td id="topicname" > ' . $post['Title'] . '</td>
                     <td>
                     <a  href="../../admin/posts/edit.php?edit_id=' . $post['id'] . ' ">edit</a>
                     </td>
                     <td>
                     <a id="deleteTop" onclick="event.preventDefault();deletePosts(' . $post['id'] . ')" href="">delete</a>
                      </td>



            </tr>';


        echo $posts_echo;
    }
}
if ($_POST["action"]== "DeletePosts"){
    $deleteIDpost = $_POST['deleteID'];
    $query = $dbh->prepare("DELETE FROM `posts` WHERE id = $deleteIDpost");
    $query->execute();
}


if ($_POST["action"]=="editpost"){
    $postname=$_POST['postname'];
    $postdics=$_POST['postdics'];
    $topID= $_POST['topID'];
    $PostimgName = time() . "_".$_FILES['img']['name'];




    $query = $dbh->prepare("UPDATE posts SET Title = :name , content = :dics , img = :img  WHERE id = $topID");
    $query->execute([
        "name"=>$postname,
        "dics"=>$postdics,
        "img"=>$PostimgName,
    ]);

}


