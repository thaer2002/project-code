<center>
    <br>
<style>
    #navbarNav a{
    color: white;
    font-weight: bold;
    text-shadow: 1px 1px 1px black;
    padding-left: 10px;
    padding-right: 10px;
    font-size: 18px;
    transition: 0.4s;
    }
    #navbarNav a:hover{
      
        border-radius: 10px;
        transition: 0.4s;
        background-color: rgba(255, 255, 255, 0.3);
    }
</style>
    <nav class="navbar navbar-expand-md  " style="background-color : rgba(223, 208, 184,0.6); width:80%; border-radius: 50px;">
        <a class="navbar-brand" href="#"><img src="img/logo.png" width="50" height="45" /></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars text-light" aria-hidden="true"></i>
        </button>
        <div class="collapse navbar-collapse " id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">الرئيسية</a>
                </li>
                <?php
                if (!isset($_SESSION["user_id"])) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">دخول</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="signup.php">حساب جديد</a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="nav-item">
                        <?php
                        if ($_SESSION['usertype'] == 'admin') {
                            echo '<a class="nav-link" href="adminPage.php">الملف الشخصي</a>';
                        } else {
                            echo '<a class="nav-link" href="userPage.php">الملف الشخصي</a>';
                        }
                        ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?out">تسجيل خروج</a>
                    </li>
                <?php
                }
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="search.php">بحث </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#start"> الجامعات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#cat"> الاقسام</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#loc"> المواقع</a>
                </li>
            </ul>
        </div>
    </nav>
    </center>
    <?php
    if (isset($_GET['out'])) {
        session_destroy();
        header('Location:index.php');
    }
    ?>