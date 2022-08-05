<?php
session_start();

?>
<!doctype html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--    jquery-->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<!--CKEditor-->
    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
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
                <h2>Добавление записи</h2>
            </div>
            <div class="row add-post">
                <div id="msg" class="mb-3 col-12 col-md-4">

                </div>
                <div class="mb-12 col-12 col-md-12 err">


                </div>
                <form action="create.php" method="post" enctype="multipart/form-data" id="testidform">
                    <div class="col mb-4">
                        <input value="" id="posts_title" name="title" type="text" class="form-control" placeholder="Title" aria-label="Название статьи">
                    </div>
                    <div class="col">
                        <label for="editor" class="form-label">Содержимое записи</label>
                        <textarea name="content" id="editor" class="form-control contentar" rows="6"></textarea>
                    </div>
                    <div class="input-group col mb-4 mt-4">
                        <input  type="file" class="form-control img " id="igsm" name="img">
<!--                        <label class="input-group-text" for="inputGroupFile02">Upload</label>-->
                    </div>
                    <div class="form-check">
                        <input name="publish" class="form-check-input" type="checkbox"  id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Опобликовать сразу?
                        </label>
                    </div>
<!--                    <select class="form-select" aria-label="Default select example">-->
<!--                        <option selected>Open this select menu</option>-->
<!--                        <option value="1">One</option>-->
<!--                        <option value="2">Two</option>-->
<!--                        <option value="3">Three</option>-->
<!--                    </select>-->
<!--                    <select name="topic" id="posts_status" class="form-select mb-2" aria-label="Default select example">-->
<!--                        <option selected>Категория поста:</option>-->
<!--                      -->
<!--                            <option value="">asd</option>-->
<!--                    -->
<!--                    </select>-->

                    <div class="col col-6">
                        <button name="add_post" id="createPostBtn" class="btn btn-primary" type="submit">Добавить запись</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>




    var myEditor;

    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
            console.log( 'Editor was initialized', editor );
            myEditor = editor;
        } )
        .catch( error => {
            console.error( error );
        } );



        //
    document.addEventListener("DOMContentLoaded", function(event){
        $('#createPostBtn').on('click',function (event){




            event.preventDefault();
            var title = $('#posts_title').val();
            var content = myEditor.getData();
            var publish =$('input#flexCheckDefault').is(':checked');

            var fd = new FormData(document.getElementById("testidform"));

            fd.append('title',title);
            fd.append('content',content);
            fd.append('pub',publish);
            fd.append('action',"createPosts");


            $.ajax({
                method: "POST",
                processData: false,
                contentType: false,
                url: "../../app/controllers/posts.php",
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
<!-- Добавление визуального редактора к текстовому полю админки -->


<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
-->

<!--<script src="../../assets/js/scripts.js"></script>-->
</body>
</html>
