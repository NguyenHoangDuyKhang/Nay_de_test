<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $ma = $_POST['code'];
  $soluong = $_POST['quantity'];
  $giatrima = $_POST['discount_type'];
  $tg = $_POST['tg'];
  //Kiểm tra cái radio xem coi nó check cái nào
  $check = $_POST['loai'];
  if ($check == 0) {
    $giatrima = substr($giatrima, 0, 2);
  } else if ($check == 1) {
    $giatrima = substr($giatrima, 0, strlen($giatrima));
  }
  $data = "INSERT INTO discount(code, quantity, discount_type,expiration_date) VALUES('$ma','$soluong','$giatrima','$tg')";
  if ($conet->query($data) === TRUE) {
    echo "<script>
    alert('Cập nhật dữ liệu thành công') ;
    </script>";
  } else {
    echo "Lỗi {$data}" . $conet->connect_error;
  }
} else {
  $thongbao = "Vui lòng nhập thông tin đầy đủ";
}
?>
<div class="card card-primary">
  <div class="card-header">
    <h1 class="card-title">Thêm Mã Giảm Giá</h1>
  </div>
  <form method="post" enctype="multipart/form-data">
    <div class="card-body">
      <div class="form-group">
        <label for="exampleInputEmail1">Mã</label>
        <input type="text" name="code" class="form-control" id="exampleInputEmail1" placeholder="Mã Giảm Giá">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Số Lượng</label>
        <input type="number" name="quantity" class="form-control" id="exampleInputPassword1" placeholder="Số Lượng">
      </div>

      <div class="form-group">
        <label for="exampleInputPassword1">Giá Trị Mã</label>
        <input type="number" step="any" name="discount_type" class="form-control" id="exampleInputPassword1"
          placeholder="Giá Trị Mã">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Loại giảm</label><br />
        <input type="radio" name="loai" id="exampleInputEmail1" value="0"> Giảm theo phần trăm
        <br />
        <input type="radio" name="loai" id="exampleInputEmail1" value="1"> Giảm theo giá tiền
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Giá Trị Sử Dụng</label>
        <input type="date" name="tg" class="form-control" id="exampleInputPassword1" placeholder="Giá Trị Sử Dụng">
      </div>
      <div style="color: red">
        <?php if (isset($thongbao)) {
          echo $thongbao;
        } ?>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary" name="btn-reg">Submit</button>
    </div>
  </form>
</div>