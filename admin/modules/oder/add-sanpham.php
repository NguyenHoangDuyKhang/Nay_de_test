<?php
include_once 'connet/connet.php';
include_once 'function/function.php';
// Lấy cái danh mục bằng cách gọi nhẹ cái hàm bên function qua
$danhmuc = Get_product_categories();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $ten_sp = $_POST['ten'];
  $mo_ta = $_POST['mota'];
  $gia = $_POST['gia'];
  $giam_gia = $_POST['giamgia'];
  $capacity = $_POST['dungluong'];
  $category_id = $_POST['category_id'];
  $thumbnail = upload($_FILES['thumbnail']);
  $view = 0;
  if (!empty($thumbnail)) {
  }
  if ($giam_gia >= $gia) {
    echo "Giá không được lớn hơn Giảm Giá!, Vui Lòng nhập lại";
  } else {
    $data_products = "INSERT INTO products( name,content,price, sale_price, capacity, category_id, thumbnail, view) 
    VALUES ('$ten_sp', '$mo_ta', '$gia', '$giam_gia','$capacity','$category_id', '$thumbnail', '$view')";
    if ($conet->query($data_products) === TRUE) {
      $thongbao2 = "Sản phẩm đã được thêm thành công!";
    } else {
      echo "Lỗi {$data_products}" . $conet->connect_error;
    }
  }
} else {
  $thongbao = "Vui lòng nhập thông tin đầy đủ";
}
mysqli_close($conet);
?>


<div class="card card-primary">

  <div class="card-header">
    <h1 class="card-title">Thêm Sản Phẩm</h1>
  </div>
  <form method="post" enctype="multipart/form-data">
    <div class="card-body">
      <div class="form-group">
        <label for="exampleInputEmail1">Tên Sản Phẩm</label>
        <input type="text" name="ten" class="form-control" id="exampleInputEmail1" placeholder="Tên Sản Phẩm">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Mô Tả sản phẩm</label>
        <input type="text" name="mota" class="form-control" id="exampleInputPassword1" placeholder="Mô Tả sản phẩm">
      </div>

      <div class="form-group">
        <label for="exampleInputPassword1">Giá</label>
        <input type="text" name="gia" class="form-control" id="exampleInputPassword1" placeholder="Giá">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Giảm giá</label>
        <input type="text" name="giamgia" class="form-control" id="exampleInputPassword1" placeholder="Giảm giá">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Dung Lượng</label>
        <input type="text" name="dungluong" class="form-control" id="exampleInputPassword1" placeholder="Dung Lượng">
      </div>
      
      <select class="form-select" aria-label="Default select example"  name="category_id">
        <?php
        foreach($danhmuc as $frint) :?>
             <option <?= (isset($_POST["categori"]) && $_POST["categori"] ===  $frint['id'] )?>  value="<?= $frint['id']?>"> <?= $frint['name'] ?> </option>
        <?php endforeach?>
      </select>


      <div class="form-group">
        <label for="exampleInputFile" name="anh">Ảnh sản phẩm</label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" name="thumbnail" class="custom-file-input" id="thumbnail">
            <label class="custom-file-label" for="exampleInputFile">Chọn file</label>
          </div>
          <div class="input-group-append">
            <span class="input-group-text">Chọn Ảnh</span>
          </div>
        </div>
      </div>
      <div style="color: red"> <?php if(isset($thongbao)){
      echo $thongbao;
    }?></div> <div style="color: blue"> <?php if(isset($thongbao2)){
      echo $thongbao2;
    }?></div>
    </div>

    <div class="card-footer">
      <button type="submit" class="btn btn-primary" name="btn-reg">Submit</button>
    </div>
  </form>
</div>