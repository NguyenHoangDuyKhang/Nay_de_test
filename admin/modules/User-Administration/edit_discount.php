<?php
$id = "";
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST['code'];
    $quantity = $_POST['quantity'];
    $discount_type = $_POST['discount_type'];
    $tg = $_POST['tg'];
    $sql_update = "UPDATE discount SET 	code = '$code', expiration_date='$tg', 
        	quantity=$quantity, discount_type=$discount_type WHERE id=$id";
    if (mysqli_query($conet, $sql_update)) {
      echo "<script>
      alert('Cập nhật dữ liệu thành công') ;
      </script>";
    } else {
      echo "Lỗi" . $sql_update . mysqli_error($conet);
    }
  }
  $sql = "SELECT * FROM discount WHERE id=$id";
  $retval = $conet->query($sql);
}
?>
<div class="card card-primary">
  <div class="card-header">
    <h1 class="card-title">Cập Nhật Mã Giảm Giá</h1>
  </div>
  <?php while ($row = $retval->fetch_assoc()): ?>
    <form method="post" enctype="multipart/form-data">
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Mã</label>
          <input type="text" name="code" class="form-control" id="exampleInputEmail1" value="<?=$row['code']?>" placeholder="Mã Giảm Giá">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Số Lượng</label>
          <input type="number" name="quantity" class="form-control" id="exampleInputPassword1" value="<?=$row['quantity']?>" placeholder="Số Lượng">
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Giá Trị Mã</label>
          <input type="number" step="any" name="discount_type" class="form-control" id="exampleInputPassword1" value="<?=$row['discount_type']?>"
            placeholder="Giá Trị Mã">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Giá Trị Sử Dụng</label>
          <input type="date" name="tg" class="form-control" id="exampleInputPassword1" value="<?=$row['expiration_date']?>" placeholder="Giá Trị Sử Dụng"> 
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary" name="btn-reg">Submit</button>
      </div>
    </form>
  <?php endwhile;
  mysqli_close($conet);
  ?>
</div>