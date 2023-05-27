
<?php
  $host = 'localhost';
  $username = 'root';
 $password = '';
 $dbname = 'webhebaphp';

// الاتصال بقاعدة البيانات
$conn = mysqli_connect($host, $username, $password, $dbname);

// التحقق من نجاح الاتصال
if (!$conn) {
    die("فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());
}
?>
