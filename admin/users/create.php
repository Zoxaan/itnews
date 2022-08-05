<?php
session_start();
 include "../../app/database/conect.php";
 $query= $dbh->prepare("SELECT role.name_role FROM role ");
 $query->execute();
 $roles= $query->fetchAll();

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Custom Styling -->
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>My blog</title>
</head>
<body>

<?php include("../../app/include/header-admin.php"); ?>

<div class="container">
    <?php include "../../app/include/sidebar-admin.php"; ?>

        <div class="posts col-9">
            <div class="button row">
                <a href="" class="col-2 btn btn-success">Создать</a>
                <span class="col-1"></span>
                <a href="" class="col-3 btn btn-warning">Редактировать</a>
            </div>
            <div class="row title-table">
                <h2>Создать пользователя</h2>
            </div>
            <div id="msg" class="mb-3 col-12 col-md-4">

            </div>
            <div class="row add-post">
                <div class="mb-12 col-12 col-md-12 err">

                </div>
                <form  method="post" id="CreateFormUser">
                    <div class="col">
                        <label for="formGroupExampleInput" class="form-label">Логин</label>
                        <input value="" type="text" class="form-control" id="Login" placeholder="введите  логин пользователя...">
                    </div>
                    <div class="col">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input  value="" type="email" class="form-control" id="Email" aria-describedby="emailHelp" placeholder="введите  email пользователя...">
                    </div>
                    <div class="col">
                        <label for="exampleInputPassword1" class="form-label">Пароль</label>
                        <input  type="password" class="form-control" id="Password" placeholder="введите  пароль пользователя...">
                    </div>
                    <div class="col">
                        <label for="exampleInputPassword2" class="form-label">Повторите пароль</label>
                        <input type="password" class="form-control" id="PasswordVer" placeholder="повторите  пароль пользователя...">
                    </div>

                    <select class="form-select mt-3 mb-3" id="select" aria-label="Default select example">

                                                <option selected>Open this select menu</option>
                        <?php
                        foreach ($roles as $key => $role):
                        ?>

                                                <option value="<?=$key+1?>"><?=$role['name_role']?></option>
                        <?php endforeach; ?>
                                            </select>

                    <div class="col">
                        <button name="create-user" class="btn btn-primary" id="CreateUserBtn" type="submit">Создать</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function (){


        $('#CreateUserBtn').on('click',function (event){
            event.preventDefault();
            var Login = $('#Login').val();
            var Email = $('#Email').val();
            var Password = $('#Password').val();
            var PasswordVer = $('#PasswordVer').val();
            var JobTitle =  $('#select').val();
            var fd = new FormData(document.getElementById("CreateFormUser"));

            fd.append('Login',Login);
            fd.append('Email',Email);
            fd.append('Password',Password);
            fd.append('PasswordVer',PasswordVer);
            fd.append('JobTitle',JobTitle);
            fd.append('action',"CreateUser");



            $.ajax({
                method: "POST",
                processData: false,
                contentType: false,
                url: "../../app/controllers/users.php",
                data:fd
            })
                .done(function( msg ) {
                    alert(msg);


                    var message_arr = jQuery.parseJSON(msg);
                    if (message_arr.key == "error_msg"){
                        var html = '<div class="alert alert-danger" role="alert">' + message_arr.message + '</div>';
                        $('div#msg').html(html);

                    }else if (message_arr.key == "success"){
                        sendIMG(message_arr.lastID);

                    }
                });


        })







    });
</script>
<!-- footer -->
<?php include("../../app/include/footer.php"); ?>
<!-- // footer -->


<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
-->
</body>
</html>
