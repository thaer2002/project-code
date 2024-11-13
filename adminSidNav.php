<link rel="stylesheet" href="style.css">
<div class="text-right" style="position: absolute; top: 80px;">
    <button type="button" id="sidebarCollapse" class="btn  " style="border-radius:0px;color:#FFF; margin-bottom: 15px;">
        <i class="fa fa-bars" aria-hidden="true" style=" font-size: 25px;"></i>
    </button>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('active');
        });
    });
</script>
<a style=" background-color: red;"></a>
<div class="wrapper" style="height:max-content;">
    <nav id="sidebar" style="min-height: 100vh;">
        <ul class="list-unstyled ">
            <p style=" margin:0px; margin-top: 30px;margin-right: -30px; color:#11235A;">
                <li><a href="adminPage.php" style="text-align: center; font-size: 20px;">لوحة التحكم</a></li>
                <hr style=" border-color:#11235A; margin:0px;  margin-right: -30px;">
            </p>
            <p style="text-align: right; font-size: 20px;  margin:0px;margin-top: 10px;margin-right: -30px; color:#11235A;"> <i class="fa fa-user" aria-hidden="true"></i> &nbsp; المستخدمين</p>
            <li><a href="allUsers.php"> حسابات المستخدمين </a></li>
            <li><a href="newUser.php">اضافة حساب جديد </a></li>
            <p style="text-align: right; font-size: 20px; margin:0px; margin-top: 10px;margin-right: -30px; color:#11235A;"> <i class="fa fa-folder" aria-hidden="true"></i> &nbsp; التصنيفات</p>
            <li><a href="allUniv.php"> الجامعات </a></li>
            <li><a href="newUniv.php"> إضافة جامعة </a></li>
            <li><a href="categories.php"> اقسام المواقع </a></li>
            <li><a href="newCategory.php"> إضافة قسام </a></li>
            <p style="text-align: right; font-size: 20px; margin:0px; margin-top: 10px;margin-right: -30px; color:#11235A;"> <i class="fa fa-map-marker" aria-hidden="true"></i> &nbsp; المواقع</p>
            <li><a href="allLocation.php"> المواقع المضافة </a></li>
            <li><a href="newLocation.php"> موقع جديد </a></li>
            <p style="text-align: right; font-size: 20px; margin:0px; margin-top: 10px;margin-right: -30px; color:#11235A;"> <i class="fa fa-cog" aria-hidden="true"></i> &nbsp; الحساب</p>
            <li><a href="editAccountInfo.php"> تعديل معلومات الحساب</a></li>
            <li><a href="?out"> تسجيل خروج</a></li>
        </ul>
    </nav>