<?php
include_once 'connet/connet.php';
include_once 'function/function.php';
// Lấy cái danh mục bằng cách gọi nhẹ cái hàm bên function qua
$danhmuc = Get_product_categories();
$id = $_GET['id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $ten_sp = $_POST['ten'];
  $mo_ta = $_POST['mota'];
  $gia = $_POST['gia'];
  $giam_gia = $_POST['giamgia'];
  $capacity = $_POST['capacity'];
  $thumbnail = upload($_FILES['thumbnail']);
  if (!empty($thumbnail)) {
    // Khỏi in ra cái gì hết vì nó thêm được rồi
  }
  $sql_update = "UPDATE products SET name = '$ten_sp', content='$mo_ta', 
        price=$gia, sale_price=$giam_gia, capacity='$capacity', thumbnail='$thumbnail' WHERE id='$id'";

  if (mysqli_query($conet, $sql_update)) {
    $thongbao2 = "Sản phẩm đã được cập nhật thành công!";
  } else {
    echo "Lỗi" . $sql_update . mysqli_error($conet);
  }
} else {
  $thongbao = "Vui lòng nhập đầy đủ thôn tin của sản phẩm để sửa sản phẩm";
}
// Gọi nhẹ cái hàm Getedit_pro để lấy thông tin sản phẩm cần edit
$data_edit = Getedit_pro($id);
?>

<div class="card card-primary">
  <div class="card-header">
    <h1 class="card-title">Sửa Sản Phẩm</h1>
  </div>
  <?php foreach ($data_edit as $row): ?>
    <form method="post" enctype="multipart/form-data">
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Tên Sản Phẩm</label>
          <input type="text" name="ten" class="form-control" id="exampleInputEmail1" placeholder=""
            value="<?= $row['name'] ?>">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Mô Tả sản phẩm</label>
          <input type="text" name="mota" class="form-control" id="exampleInputPassword1" placeholder="Mô Tả sản phẩm"
            value="<?= $row['content'] ?>">
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Giá</label>
          <input type="text" name="gia" class="form-control" id="exampleInputPassword1" placeholder="Giá"
            value="<?= $row['price'] ?>">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Giảm giá</label>
          <input type="text" name="giamgia" class="form-control" id="exampleInputPassword1" placeholder="Giảm giá"
            value="<?= $row['sale_price'] ?>">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Dung Lượng</label>
          <input type="text" name="capacity" class="form-control" id="exampleInputPassword1" placeholder="Luồng"
            value="<?= $row['capacity'] ?>">
        </div>

        <select class="form-select" aria-label="Default select example" name="category_id">
          <?php
          foreach ($danhmuc as $frint): ?>
            <option <?= (isset($_POST["categori"]) && $_POST["categori"] === $frint['id']) ?> value="<?= $frint['id'] ?>">
              <?= $frint['name'] ?>
            </option>
          <?php endforeach ?>

        </select>
        <div class="form-group">
          <label for="exampleInputFile" name="anh">Ảnh sản phẩm</label>
          <div class="input-group">
            <div class="custom-file">
              <input type="file" name="thumbnail" class="custom-file-input" id="thumbnail">
              <label class="custom-file-label" for="exampleInputFile">Chọn file</label>
            </div>
          </div>
          <div style="color: red">
            <?php if (isset($thongbao)) {
              echo $thongbao;
            } ?>
          </div>
          <div style="color: blue">
            <?php if (isset($thongbao2)) {
              echo $thongbao2;
            } ?>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-primary" name="btn-reg">Submit</button>
        </div>
    </form>
  <?php endforeach;
  mysqli_close($conet);
  ?>
</div>