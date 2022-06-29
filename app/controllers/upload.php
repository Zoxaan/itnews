<?php
if (isset($_FILES['img'])){
    $msgID = $_GET["msgIDget"];

    $imgName = $_FILES['img']['name'];
    $imgType = $_FILES['img']['type'];
    $imgtemp = $_FILES['img']['tmp_name'];
    $imgsize = $_FILES['img']['size'];

    $img_filder = "../../assets/images/".$imgName;
    $result = move_uploaded_file($imgtemp,$img_filder);

}
