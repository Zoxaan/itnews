<?php

?>
<header class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h1>
                    <a href="">ITnews</a>
                </h1>
            </div>
            <nav class="col-8">
                <ul>
                    <li><a href="">Главная</a> </li>
                    <li><a href="">О нас</a> </li>
                    <li><a href="#">Услуги</a> </li>
                    <li>
                       <?php if (isset($_SESSION['id'])): ?>
                            <a href="#">
                                <i class="fa fa-user"><?=$_SESSION['login']?></i>
                            </a>
                       <ul>
                           <?php if ($_SESSION['adminstatus'] == 1): ?>

                               <li>  <a href="admin/posts/index.php">Админ панель</a></li>

                           <?php endif;?>
                           <li>  <a href="profile.php?userID=<?=$_SESSION['id'] ?>">Профиль</a></li>

                               <li><a href="../../logout.php">Выход</a> </li>
                       </ul>

                       <?php else: ?>
                           <a href="#">
                               <i class="fa fa-user">Личный кабенет</i>
                           </a>
                        <ul>
                            <li><a href="../../log.php">ВХод</a> </li>
                            <li><a href="../../reg.php">Регистрация</a> </li>
                            <li><a href="../../logout.php">Выход</a> </li>
                            </ul>
                      
                            <?php endif;?>
                        
               

                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
