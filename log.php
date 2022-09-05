<?php
session_start();
?>
<html lang="eng">
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
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>My blog</title>
</head>
<body>

<?php include("app/include/header.php"); ?>

<!-- END HEADER -->
<!-- FORM -->
<div class="container reg_form">
    <form class="row justify-content-center" method="post" >
        <h2 class="col-12">Авторизация</h2>
        <div class="mb-3 col-12 col-md-4 err">
            <p></p>
        </div>

        <div class="w-100"></div>

        <div class="mb-3 col-12 col-md-4">
            <div class="msg" role="alert">

            </div>
            <label for="formGroupExampleInput" class="form-label">Ваша почта (при регистрации)</label>
            <input name="mail" value="<?=$_SESSION['email']?>" type="email" class="form-control email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="введите ваш email...">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="exampleInputPassword1" class="form-label">Пароль</label>
            <input name="password" type="password" class="form-control pass" id="exampleInputPassword1" placeholder="введите ваш пароль...">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <button type="submit" id="btn_log" name="button-log" class="btn btn-secondary">Войти</button>
            <a href="aut.html">Зарегистрироваться</a>
        </div>
    </form>
</div>
<!-- END FORM -->


<script>
    $(document).ready(function (){

       $('#btn_log').on('click',function (event){
           event.preventDefault();
         var email =  $('input.email').val();
         var password =  $('input.pass').val();



           $.ajax({
               method: "POST",
               url: "/app/controllers/users.php",
               data: {
                   email: email,
                   password: password,
                   action:"log"
               }
           })
               .done(function( msg ) {
                   console.log(msg);
                   var message_arr = jQuery.parseJSON(msg);
                   if(message_arr.key == "error"){
                       var html = '<div class="alert alert-danger" role="alert">' + message_arr.message + '</div>';
                       $('div.msg').html(html);

                   }else{
                       window.location.href = 'index.php';
                   }



               });
       })

    });
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
