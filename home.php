<?php
include_once 'admin/connet/connet.php';
$user_name = "";
$email = "";
$password = "";
$cf_pass = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){
  $user_name = $_POST['username'];
  $email = $_POST['email'];
  $password =  $_POST['password'];
  $cf_pass = $_POST['password2'];
  $mahoapass = password_hash($password, PASSWORD_DEFAULT);
}

 if(!empty($user_name) && !empty($email) && !empty($password) && !empty($cf_pass)){
  if(password_verify( $cf_pass, $mahoapass)){
  $sql_sign_up = "INSERT INTO users (name, email, password) 
  VALUES ('$user_name', '$email', '$mahoapass')";
   if($conet->query($sql_sign_up)===TRUE){
    $thongbao = "Đăng ký tài khoảng thành công!";
  }
  else {
    echo "Lỗi {$sql_sign_up}" .$conet->connect_error;
  }
}else{
  $thongbao_thatbai =  "Mật khẩu không khớp, Vui lòng nhập lại";
}
  }
mysqli_close($conet);
?>
  <link rel="stylesheet" href="style.css">
<form action="" method="post" enctype="multipart/form-data" class="form-dang-ky">
<div id="login-box">
  <div class="left">
    <h1>Sign up</h1>
    <input type="text" name="username" placeholder="Username" />
    <input type="text" name="email" placeholder="E-mail" />
    <input type="password" name="password" placeholder="Password" />
    <input type="password" name="password2" placeholder="Confirm password" />
    <?php      if(isset($thongbao)){
                echo $thongbao;
              }

              if(isset($thongbao_thatbai)){
                echo $thongbao_thatbai;
              }
    ?>
    <input type="submit" name="signup_submit" value="Sign up" /> 
    <br/>

    <a href="http://asm/dangnhap.php">I have an account</a>
    </br>
    OR
    <a href="http://asm/index.php">return to home page</a>

  </div>
  <div class="right">
  
  </div>
</div>
</form>