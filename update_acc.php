<?php
include_once 'admin/connet/connet.php';
include_once 'admin/function/function.php';
session_start();
$email = "";
$user = "";
$pass = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $user = $_POST['user'];
  $pass = $_POST['Password'];
}
if (isset($_POST['email']) && isset($_POST['Password']) && isset($_POST['user'])) {
  if ($_SESSION['email'] == $_POST['email']) {
    $sql_update = "UPDATE users SET name = '$user', cf_password='$pass' WHERE email='$email'";
    if (mysqli_query($conet, $sql_update)) {
      $thongbaothanhcong = "Cập nhật mật khẩu thành công!";
    } else {
      $thongbaothanhcong = "Cập nhật mật khẩu thất bại!";
    }
  } else {
    $thongbao = "Email không khớp, Vui lòng nhập lại Email để có thể cập nhật Account";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
    rel="stylesheet">

  <title>Wolves Phones - Update</title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
  <link rel="stylesheet" href="assets/css/owl.css">
</head>

<body>
  <header>
    <? include_once 'components/header.php' ?>
  </header>

  <br /><br /><br /><br /><br />
  <div class="latest-products">
    <div class="container ">
      <div class="row">
        <div class="col-md-6 container">
          <div class="card card-primary">

            <div class="card-header">
              <h1 class="card-title container">Cập Nhật Tài Khoản</h1>
            </div>
            <form method="post" enctype="multipart/form-data" >
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputPassword1">Email</label>
                  <input type="email" name="email" class="form-control" id="exampleInputPassword1" placeholder="email">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Tên Mới</label>
                  <input type="text" name="user" class="form-control" id="exampleInputPassword1"
                    placeholder="Tên Mới">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Mật Khẩu Mới</label>
                  <input type="text" name="Password" class="form-control" id="exampleInputPassword1"
                    placeholder="Mật Khẩu Mới">
                </div>
                <div style="color: #0000FF">
                  <?php
                  if (isset($thongbaothanhcong)) {
                    echo $thongbaothanhcong;
                  }
                  ?>
                </div>
                <div style="color: red">
                  <?php
                  if (isset($thongbao)) {
                    echo $thongbao;
                  }
                  ?>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary" name="btn-reg">Cập Nhật</button>
              </div>
            </form>
          </div>
          <?php
          include_once "components/footer.php";
          ?>
          <script src="vendor/jquery/jquery.min.js"></script>
          <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
          <script src="assets/js/custom.js"></script>
          <script src="assets/js/owl.js"></script>
          <script src="assets/js/slick.js"></script>
          <script src="assets/js/isotope.js"></script>
          <script src="assets/js/accordions.js"></script>


          <script language="text/Javascript">
            cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
            function clearField(t) {                   //declaring the array outside of the
              if (!cleared[t.id]) {                      // function makes it static and global
                cleared[t.id] = 1;  // you could use true and false, but that's more typing
                t.value = '';         // with more chance of typos
                t.style.color = '#fff';
              }
            }
          </script>


</body>

</html>