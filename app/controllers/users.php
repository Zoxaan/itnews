<?php
session_start();
include '../database/conect.php';
$message = array();

if ( $_POST['action'] == "reg_user"){

    $username =  trim($_POST['username']);
    $email =  $_POST['email'];
    $password =  trim($_POST['password']);
    $pass_ver =  trim($_POST['pass_ver']);

    $status = 2;





    if ($_FILES['img']['name'] == ''){
        $imgName = "not_found.png";

    }else{
        $imgName = time() .'_'. $_FILES['img']['name'];
        $imgType = $_FILES['img']['type'];
        $imgtemp = $_FILES['img']['tmp_name'];
        $imgsize = $_FILES['img']['size'];

        $img_filder = "../../assets/avatars/" . $imgName;
        $result = move_uploaded_file($imgtemp, $img_filder);
    }




    $userEmail = $dbh->prepare("SELECT `email` FROM `users` WHERE `email` = :email ");
    $userEmail->execute([
        "email"=>$email
    ]);

    $CountEmail = $userEmail->rowCount();





    if ($username === "" || $email=== "" || $password === "" ){
        $message[] = 'Нужно заполнить все поля';
    }elseif(mb_strlen($email,'UTF-8') <2)  {
        $message[] = 'короткий майл';
    }elseif ($CountEmail >0){
        $message[] = 'Введеный эмайл уже зарегестрирован';
    }elseif (mb_strlen($username,'UTF-8') <2){
        $message[] = 'короткий логин';
    }elseif($password !== $pass_ver){
        $message[] = 'Введеные пароли не совпадают';

    }


    if (!empty($message)) {
        $error_array = ["key" => "error", "message" => $message];
        echo json_encode($error_array);
    }else{
        $error_array = ["key" => "success", "message" => "Регестрация прошла успешно"];
        $user = $dbh->prepare("INSERT INTO `users` (email,username,password,avatar,jobtitle) VALUES (:email , :username, :password,:avatar, :status )");
        $user->execute([
            "email"=>$email,
            "username"=>$username,
            "password"=> password_hash($password,PASSWORD_DEFAULT),
            "avatar" => $imgName,
            "status"=>$status
        ]);
        $userID = $dbh->lastInsertId();
        $userdata = $dbh->prepare("SELECT users.username,users.jobtitle FROM users WHERE id = $userID");
        $userdata->execute();
        $userdata = $userdata->fetch(PDO::FETCH_ASSOC);

        $_SESSION['user'] = [
            $_SESSION['id'] = $userID,
            $_SESSION['login'] = $userdata['username'],
            $_SESSION['adminstatus'] = $userdata['jobtitle']
        ];
        echo json_encode($error_array);





    }
}

if ($_POST["action"] == "log"){

    $email = $_POST['email'];
    $password = $_POST['password'];



    if ( $email=== "" || $password === "" ){
        $message[] = 'Нужно заполнить все поля';

    }else{
        $userval = $dbh->prepare("SELECT * FROM users WHERE email = :email");
        $userval->execute([
            "email"=>$email,
        ]);

        $user = $userval->fetch(PDO::FETCH_ASSOC);

//        $passwordhash =$user['password'];

        if ($user['email']!==$email){
            $message[] = 'Пользователь с введеным эмайлом не зарегестрирован';
        }elseif(password_verify($password,$user['password']) === true){
                $_SESSION['user'] = [
                $_SESSION['id'] = $user['id'],
                $_SESSION['login'] = $user['username'],
                $_SESSION['adminstatus'] = $user['jobtitle']

            ];
        }else{
            $message[] = 'Проверьте правильность введеных полей';
        }
    }

    if (!empty($message)) {
        $error_array = ["key" => "error", "message" => $message];
        echo json_encode($error_array);
    }else{
        $compl_arr = ["key" => "compl", "message" => "completed login"];
        echo json_encode($compl_arr);
    }


























}








