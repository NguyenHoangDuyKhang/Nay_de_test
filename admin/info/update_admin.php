<?php
include_once "connet/connet.php";
$email = "";
$user = "";
$pass = "";
$new_name = "";
$new_pass = "";
$sql = "SELECT * FROM users WHERE role = 1";
$retval = $conet->query($sql);
while($row = $retval->fetch_assoc()){
    $data[] = $row;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $user = $_POST['user'];
    $pass = $_POST['password'];
    $new_name = $_POST['new_user'];
    $new_pass = $_POST['new_pass'];
    $mahoa =  password_hash( $new_pass, PASSWORD_DEFAULT);
}
foreach($data as $info){
if (isset($_POST['email']) && isset($_POST['user']) && isset($_POST['password']) && isset($_POST['new_user']) && isset($_POST['new_pass'])) {
    if ($info['email'] ==  $email && $info['name'] == $user && password_verify($pass, $info['password'])) {
        $sql_update = "UPDATE users SET name = '$new_name', password ='$mahoa' WHERE email='$email'";
        if (mysqli_query($conet, $sql_update)) {
            $thongbaothanhcong = "Cập nhật mật khẩu thành công!";
        } else {
            $thongbao = "Cập nhật mật khẩu thất bại!";
        }
    }
}
}
?>
<div class="latest-products">
    <div class="container ">
        <div class="row">
            <div class="col-md-6 container">
                <div class="card card-primary">
                    <div class="card-header">
                        <h1 class="card-title container">Cập Nhật Tài Khoản ADMIN</h1>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputPassword1">EMAIL</label>
                                <input type="text" name="email" class="form-control" id="exampleInputPassword1"
                                    placeholder="EMAIL" required="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">TÊN ĐĂNG NHẬP</label>
                                <input type="text" name="user" class="form-control" id="exampleInputPassword1"
                                    placeholder="USER" required="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">MẬT KHẨU</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                                    placeholder="PASSWORD" required="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">TÊN MỚI(TÊN ADMIN)</label>
                                <input type="text" name="new_user" class="form-control" id="exampleInputPassword1"
                                    placeholder="Tên Mới" required="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">MẬT KHẨU MỚI</label>
                                <input type="password" name="new_pass" class="form-control" id="exampleInputPassword1"
                                    placeholder="Mật Khẩu Mới" required="">
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

            </div>
        </div>
    </div>