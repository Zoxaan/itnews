<header class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h1>
                    <a href="">My blog</a>
                </h1>
            </div>
            <nav class="col-8">
                <ul>
                    <li>
                        <a href="#">
                            <i class="fa fa-user"><?php echo $_SESSION['login']; ?></i>

                        </a>
                    </li>
                    <li>
                        <a href="../../logout.php">Выход</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
