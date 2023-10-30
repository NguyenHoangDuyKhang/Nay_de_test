<?php
include_once 'admin/connet/connet.php';
include_once 'admin/function/function.php';
session_start();
$name = "";
$email = "";
$password = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $email = $_POST['email'];
  $password = $_POST['password'];
}

$sql = "SELECT * FROM users WHERE email = '$email'";
$retval = $conet->query($sql);
$row = $retval->fetch_assoc();
if(isset($_POST['email']) && isset($_POST['password'])){
  if(isset($row['email']) && $row['email'] ==  $email && password_verify($password, $row['password'])){
    echo "<script>
    alert('ĐĂNG NHẬP THÀNH CÔNG') ;
    </script>";
    $name = $row['name'];
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $name;
    $_SESSION['id'] = $row['id'];
    header('Location: http://asm/index.php');
  } else{
    $thongbao = "Mật khẩu hoặc Email không khớp, Vui lòng nhập lại";
  }
}
?>
  <link rel="stylesheet" href="style.css">
<form action="" method="post" enctype="multipart/form-data">
<div id="login-box">
  <div class="left">
    <h1>Sign in</h1>
    <input type="text" name="email" placeholder="E-mail" />
    <input type="password" name="password" placeholder="Password" />
    <?
              if(isset($thongbao)){
                echo $thongbao;
              }
             ?>
    <input type="submit" name="signup_submit" value="Sign in" /> 
    <br/> <br/>
    <a href="http://asm/home.php">I haven't an account</a>
    <p>Or</p>
    <a href="http://asm/index.php">return to home page</a>
  </div>
  <div class="right2">
  
  </div>

</div>
</form>
