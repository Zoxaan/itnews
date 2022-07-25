<?php
include 'app/database/conect.php';
$user_id = $_GET['userid'];

$user = $dbh->prepare("SELECT users.*, role.name_role FROM users JOIN role ON users.id = $user_id ");
$user->execute();

$user = $user->fetch();

$colwo_posts = $dbh->prepare("SELECT * FROM posts WHERE user_id = $user_id");
$colwo_posts->execute();
$colwo_posts = $colwo_posts->rowCount();







?>

<!DOCTYPE html>
<html>
<head>
	<title>Мой профиль</title>
	<link rel="stylesheet" type="text/css" href="assets/css/styleProfile.css">
</head>
<body>
	<div class="card">
		<div class="imgBx">
			<br>
			<br>
			<img src="https://w.wallpaperkiss.com/wimg/s/114-1143952_small.jpg">
		</div>
		<div class="content">
			<div class="details">
				<h2> Никнейм: <?=$user['username']?></h2><span>
                    Rank: <?=$user['name_role']?>
                </span>
                </h2>
				<div class="data">
					<h3><?=$colwo_posts?><br><span>Постов</span></h3></br>

				</div>
				<div class="actionBtn">
					<a href="https://www.youtube.com/channel/UCw8p_ZEJqLigEHvWuzqS04w"><button>Подпишитесь</button></a>
					<button>Написать сообщение</button>
				</div>
			</div>
		</div>
	</div>
</body>
</html>