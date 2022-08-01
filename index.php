<?php
session_start();
include "/app/database/conect.php";

//$query = $dbh->prepare("SELECT posts.img FROM posts WHERE hot=1 ");
$query = $dbh->prepare("SELECT * FROM posts WHERE hot=1 ");
$query->execute();
$HotPosts = $query->fetchAll();


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
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>ITnews</title>
</head>
<body>

<?php include("app/include/header.php"); ?>





<!-- блок карусели START-->
<div class="container">
    <div class="row">
        <h2 class="slider-title">Топ публикации</h2>
    </div>
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-inner">
            <?php foreach($HotPosts as $key=> $hotePost): ?>
            <?php if($key == 0): ?>

            <div class="carousel-item active">
                <?php else: ?>
                <div class="carousel-item">
                    <?php endif ;?>
                    <img src="<?='assets/images/' .$hotePost['img']?>" class="d-block w-100" alt="...">
                    <div class="carousel-caption-hack carousel-caption d-none d-md-block">

                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"  data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"  data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

<!-- блок карусели END-->



<!-- блок main-->
<div class="container">
    <div class="content row">
        <!-- Main Content -->
        <h2 class="mt-5 mb-5" >Последние публикации</h2>
        <div class="main-content col-md-9 col-12" id="posts">

            
                <div class="post row">
                    <div class="img col-12 col-md-4">
                        <img src="../assets/images/image_4.png" class="img-thumbnail">
                    </div>
                    <div class="post_text col-12 col-md-8">
                        <h3>
                            <a href=""> </a>
                        </h3>
                        <i class="far fa-user">Пользователь 1 </i>
                        <i class="far fa-calendar">22.02.2022</i>
                        <p class="preview-text">

                            Стоит прочитать: обзор книги Аллена Б. Дауни «Think Python. Основы Python»
                        </p>
                    </div>
                </div>
           
        </div>
        <!-- sidebar Content -->
        <div class="sidebar col-md-3 col-12">

            <div class="section search">
                <h3>Поиск</h3>
                <form action="search.php" method="post">
                    <input type="text" name="search-term" class="text-input" placeholder="Введите искомое слово...">
                </form>
            </div>


            <div class="section topics">
                <h3>Категории</h3>
                <ul>
                   
                    <li>
                        <a href="">php</a>
                        <a href="">JS</a>
                        <a href="">css</a>
                    </li>
                   
                </ul>
            </div>

        </div>

    </div>

</div>

    <script>
        $(document).ready(function (){
            LoadPosts();
            function LoadPosts(){
                $.ajax({
                    method: "POST",
                    url: "/app/controllers/posts.php",
                    data: {
                        action: "loadPostsInIndex"
                    }
                })
                    .done(function( msg )
                    {

                        var html = msg;
                        $('#posts').html(html);
                    });
             //   setTimeout(LoadPosts, 500);

            }


        });
    </script>

<!-- блок main END-->
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