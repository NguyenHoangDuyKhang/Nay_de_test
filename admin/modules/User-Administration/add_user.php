<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user = $_POST['user'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $mahoapass = password_hash($password, PASSWORD_DEFAULT);
  //Kiểm tra cái radio xem coi nó check cái nào
  $check = $_POST['chucvu'];
  $data = "INSERT INTO users(name, email, password,role) VALUES('$user','$email','$mahoapass',$check)";
  if ($conet->query($data) === TRUE) {
    $thongbao_tc =  "Thành công rồi á";
  } else {
    echo "Lỗi {$data}" . $conet->connect_error;
  }
} else {
  $thongbao = "Vui lòng nhập thông tin đầy đủ";
}
?>
<div class="card card-primary">
  <div class="card-header ">
    <h1 class="card-title">Thêm Người Dùng</h1>
  </div>
  <form method="post" enctype="multipart/form-data">
    <div class="card-body">
      <div class="form-group">
        <label for="exampleInputEmail1">Tên Người Dùng</label>
        <input type="text" name="user" class="form-control" id="exampleInputEmail1" placeholder="Tên Người Dùng">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Email</label>
        <input type="email" name="email" class="form-control" id="exampleInputPassword1" placeholder="Email">
      </div>

      <div class="form-group">
        <label for="exampleInputPassword1">Mật Khẩu</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1"
          placeholder="Mật Khẩu">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Chức Vụ</label><br />
        <input type="radio" name="chucvu" id="exampleInputEmail1" value="1"> Admin
        <br />
        <input type="radio" name="chucvu" id="exampleInputEmail1" value="0"> Người Dùng
      </div>
      <div style="color: red">
        <?php
         if (isset($thongbao)) {
          echo $thongbao;
        } 
        ?>
      </div>
      <div style="color: blue">
        <?php
         if (isset($thongbao_tc)) {
          echo $thongbao_tc;
        } 
        ?>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary" name="btn-reg">Submit</button>
    </div>
  </form>
</div>