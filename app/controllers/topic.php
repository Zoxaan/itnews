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
        echo json_encode($success_msg);
        $topicsadd = $dbh->prepare("INSERT INTO categories (name,dics) VALUES (:name , :content)");
        $topicsadd->execute([
            "name" => $nameTopic,
            "content"=>$content,
        ]);
    }







}

if ($_POST['action'] =="loadTop" ){


        $query = $dbh->prepare("SELECT * FROM categories");
        $query->execute();
        $topics = $query->fetchAll(PDO::FETCH_ASSOC);


    foreach ($topics as $key => $topic){
        $number = $key + 1;
        $top =
            '<tr>
                    <td> '.$number.'</td>
                     <td id="topicname" > '.$topic['name'].'</td>
                     <td>
                     <a  href="../../admin/topics/edit.php?edit_id='.$topic['id'].' ">edit</a>
                     </td>
                     <td>
                     <a id="deleteTop" onclick="event.preventDefault();deleteTopics('.$topic['id'].')" href="">delete</a>
                      </td>



            </tr>';


        echo $top;

    }


}

if ($_POST['action']=="DeleteTopics"){
    $deleteIDtopic = $_POST['deleteID'];
    $query = $dbh->prepare("DELETE FROM `categories` WHERE id = $deleteIDtopic");
    $query->execute();

}



if ($_POST["action"]=="edittopic"){
    $topicname=$_POST['topicname'];
    $topicdics=$_POST['topicdics'];
    $topID= $_POST['topid'];



 $query = $dbh->prepare("UPDATE categories SET name = :name , dics = :dics  WHERE id = $topID");
 $query->execute([
    "name"=>$topicname,
    "dics"=>$topicdics,
 ]);

}





