<?php
include 'app/database/conect.php';
$userID = $_GET['userid'];
$user = $dbh->prepare("SELECT users.*, role.name_role FROM users JOIN role ON users.jobtitle = role.id_role AND users.id = $userID");
$user->execute();

$user = $user->fetch();

$colwo_posts = $dbh->prepare("SELECT * FROM posts WHERE user_id = $userID");
$colwo_posts->execute();
$colwo_posts = $colwo_posts->rowCount();

var_dump($user);
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="/assets/css/profile.css">
</head>
<body>
<div class="row py-5 px-4"> <div class="col-md-5 mx-auto"> <!-- Profile widget --> <div class="bg-white shadow rounded overflow-hidden"> <div class="px-4 pt-0 pb-4 cover"> <div class="media align-items-end profile-head"> <div class="profile mr-3"><img src="assets/avatars/<?=$user['avatar']?>" alt="..." width="320"  class="rounded mb-2 img-thumbnail"><a href="#" class="btn btn-outline-dark btn-sm btn-block">Edit profile</a></div> <div class="media-body mb-5 text-white"> <h4 class="mt-0 mb-0">Mark Williams</h4> <p class="small mb-4"> <i class="fas fa-map-marker-alt mr-2"></i>New York</p> </div> </div> </div> <div class="bg-light p-4 d-flex justify-content-between text-center"> <ul>

                    <?php if ($user['name_role'] == "admin"): ?>

                    <li class="role_admin" > Администратор </li>
                    <?php elseif($user['name_role'] == "moder"): ?>
                    <li class="role_moder" > Модератор </li>
                    <?php elseif($user['name_role'] == "user"): ?>
                        <li class="role_user" > Пользователь </li>
                    <?php endif ?>



                </ul>
                <ul class="list-inline mb-0"> <li class="list-inline-item"> <h5 class="font-weight-bold mb-0 d-block"><?=$colwo_posts?></h5><small class="text-muted"> <i class="fas fa-image mr-1"></i>Постов</small> </li> <li class="list-inline-item"> </li> <li class="list-inline-item"> </li> </ul> </div> <div class="px-4 py-3"> <h5 class="mb-0">About</h5> <div class="p-4 rounded shadow-sm bg-light"> <p class="font-italic mb-0">Web Developer</p> <p class="font-italic mb-0">Lives in New York</p> <p class="font-italic mb-0">Photographer</p> </div> </div> <div class="py-4 px-4"> <div class="d-flex align-items-center justify-content-between mb-3"> <h5 class="mb-0">Recent photos</h5><a href="#" class="btn btn-link text-muted">Show all</a> </div> <div class="row"> <div class="col-lg-6 mb-2 pr-lg-1"><img src="https://images.unsplash.com/photo-1469594292607-7bd90f8d3ba4?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80" alt="" class="img-fluid rounded shadow-sm"></div> <div class="col-lg-6 mb-2 pl-lg-1"><img src="https://images.unsplash.com/photo-1493571716545-b559a19edd14?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80" alt="" class="img-fluid rounded shadow-sm"></div> <div class="col-lg-6 pr-lg-1 mb-2"><img src="https://images.unsplash.com/photo-1453791052107-5c843da62d97?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80" alt="" class="img-fluid rounded shadow-sm"></div> <div class="col-lg-6 pl-lg-1"><img src="https://images.unsplash.com/photo-1475724017904-b712052c192a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80" alt="" class="img-fluid rounded shadow-sm"></div> </div> </div> </div> </div>
</div>
</body>
</html>