<?php
session_start();
?>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
          <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- Custom Styling -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>My blogad</title>
</head>
<body>

<?php include("app/include/header.php"); ?>
<!-- END HEADER -->
<!-- FORM -->
<div class="container reg_form">
    <form  method="post" enctype="multipart/form-data " id="reguserform" >
        <div class="row justify-content-center">
        <h2>Форма регистрации</h2>
        <div class="mb-3 col-12 col-md-4 err">
            <p></p>
        </div>
            <div class="w-100"></div>

            <div id="msg" class="mb-3 col-12 col-md-4">

            </div>
        <div class="w-100"></div>

        <div class="mb-3 col-12 col-md-4">
            <label for="formGroupExampleInput"  class="form-label">Ваш логин</label>
            <input name="login" value="" id="username" type="text" class="form-control" id="formGroupExampleInput" placeholder="введите ваш логин...">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="exampleInputEmail1"  class="form-label">Email</label>
            <input name="mail" value="" id="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="введите ваш email...">
            <div id="emailHelp" class="form-text">Ваш email адрес не будет использован для спама!</div>
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="exampleInputPassword1" class="form-label">Пароль</label>
            <input name="pass-first" id="password"  type="password" class="form-control" id="exampleInputPassword1" placeholder="введите ваш пароль...">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="exampleInputPassword2"  class="form-label">Повторите пароль</label>
            <input name="pass-second" id="pass_ver" type="password" class="form-control" id="exampleInputPassword2" placeholder="повторите ваш пароль...">
        </div>


        <div class="w-100"></div>
            <div class="mb-2 col-12 col-md-4">
                <input  type="file" class="form-control img " id="igsm" name="img">

            </div>
            <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <button type="submit" class=" reg btn btn-secondary" name="button-reg">Регистрация</button>
            <a href="aut.html">Войти</a>
        </div>


    </div>
    </form>
</div>
<!-- END FORM -->

<script>




    $(document).ready(function (){
        $('button.reg').on('click',function (event){
            event.preventDefault();
            var username = $('input#username').val();
            var email = $('input#email').val();
            var pass = $('input#password').val();
            var pass_ver = $('input#pass_ver').val();
            var fd = new FormData(document.getElementById("reguserform"));

            fd.append('username',username);
            fd.append('email',email);
            fd.append('password',pass);
            fd.append('pass_ver',pass_ver);
            fd.append('action',"reg_user");



            $.ajax({
                method: "POST",
                processData: false,
                contentType: false,
                url: "../../app/controllers/users.php",
                data:fd
            })
                .done(function( msg ) {
                    alert(msg);


                    console.log(msg);
                                var message_arr = jQuery.parseJSON(msg);
                                if(message_arr.key == "error"){
                                    var html = '<div class="alert alert-danger" role="alert">' + message_arr.message + '</div>';
                                    $('div#msg').html(html);

                                }else{
                                     window.location.href = 'index.php';
                                }
                });

        })


    });









//    gotoviy variant

    // $(document).ready(function(){
    //
    //     $('button.reg').on('click',function(event){
    //         event.preventDefault();
    //       var username = $('input#username').val();
    //       var email = $('input#email').val();
    //       var pass = $('input#password').val();
    //       var pass_ver = $('input#pass_ver').val();
    //       $.ajax({
    //         method: "POST",
    //         url: "/app/controllers/users.php",
    //         data: {
    //             username: username,
    //             email: email,
    //             password: pass,
    //             pass_ver: pass_ver,
    //             action: "reg_user"
    //          }
    //         })
    //         .done(function( msg )
    //         {
    //             console.log(msg);
    //             var message_arr = jQuery.parseJSON(msg);
    //             if(message_arr.key == "error"){
    //                 var html = '<div class="alert alert-danger" role="alert">' + message_arr.message + '</div>';
    //                 $('div#msg').html(html);
    //
    //             }else{
    //                 // window.location.href = 'index.php';
    //             }
    //         });
    //     })
    // });
</script>

<!-- footer -->
<?php include("app/include/footer.php"); ?>
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
