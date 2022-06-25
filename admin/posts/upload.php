<?php

$path = "uploads/" . $_FILES["image"]["name"];
move_uploaded_file($_FILES["image"]["tmp_name"], $path);

$msgID = $_GET["msgIDget"];
