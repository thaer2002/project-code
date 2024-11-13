<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #DFD0B8; border-bottom: solid 1px #000;">
  <a class="navbar-brand" href="#"><img src="img/logo.png" width="50" height="50" /></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
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
        <a class="nav-link" href="search.php"> بحث على الخريطه</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">المساعدة والدعم</a>
      </li>
    </ul>
  </div>
</nav>
<?php
if (isset($_GET['out'])) {
  session_destroy();
  header('Location:index.php');
}
?>