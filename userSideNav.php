<link rel="stylesheet" href="style.css">
<div class="text-right" style="position: absolute; top: 80px;">
    <button type="button" id="sidebarCollapse" class="btn  " style="border-radius:0px;color:#11235A">
        <i class="fa fa-bars" aria-hidden="true" style=" font-size: 25px;"></i>
    </button>
</div>
<div class="wrapper">
    <nav id="sidebar"  style="min-height: 100vh;">
        <ul class="list-unstyled ">
            <p style=" margin:0px; margin-top: 30px;margin-right: -30px; color:#11235A;">
                <li><a href="userPage.php" style="text-align: center; font-size: 20px;">لوحة التحكم</a></li>
                <hr style="color: white; border-color:#11235A; margin:0px;  margin-right: -30px;">
            </p>
            <p style="text-align: right; font-size: 20px; margin:0px; margin-top: 10px;margin-right: -30px; color:#11235A;"> <i class="fa fa-map-marker" aria-hidden="true"></i> &nbsp; المواقع </p>
            <li><a href="newLocation.php"> موقع جديد </a></li>
            <li><a href="userAllLocation.php"> المواقع المضافة </a></li>
            <li><a href="savedLocation.php">   المواقع المحفوظه </a></li>
            <li><a href="nearLocation.php">  المواقع القريبه </a></li>
            <li><a href="locationHistory.php"> سجل البحث </a></li>
         
            <p style="text-align: right; font-size: 20px; margin:0px; margin-top: 10px;margin-right: -30px; color:#11235A;"> <i class="fa fa-cog" aria-hidden="true"></i> &nbsp; الحساب</p>
            <li><a href="editAccountInfo.php"> تعديل بيانات الحساب</a></li>
            <li><a href="?out"> تسجيل خروج</a></li>
        </ul>
    </nav>