<?php
include 'app/database/conect.php';
$user_id = $_GET['userid'];

$user = $dbh->prepare("SELECT * FROM users WHERE id = $user_id");
$user->execute();

$user = $user->fetch();

var_dump($user);
exit();



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
                    Rank: <?php

                    ?>
                </span>
                </h2>
				<div class="data">
					<h3>111<br><span>Постов</span></h3></br>
					<h3>777<br><span>Подписчиков</span></br></h3>
					<h3>333<br><span>Подписок</span></br></h3>
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