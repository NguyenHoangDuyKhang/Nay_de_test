<?php
include_once 'connet/connet.php';
include_once 'function/function.php';
$id = $_GET['id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  echo "<br>";
  $name = $_POST['name_post'];
  $content = $_POST['content'];
  $slug = $_POST['slug'];
  $category_id = $_POST['category_id'];
  $thumbnail = upload($_FILES['thumbnail']);
  if (!empty($thumbnail)) {
    echo "Tệp tin đã được tải lên thành công. Đường dẫn: " . $thumbnail;
  }

  $sql = "UPDATE posts SET name = '$name', content='$content', 
      slug='$slug', category_id='$category_id', thumbnail='$thumbnail' WHERE id='$id'";

  if (mysqli_query($conet, $sql)) {
    echo "Cập nhật dữ liệu thành công";
  } else {
    echo "Lỗi" . $sql . mysqli_error($conet);
  }
}
$sql = "SELECT * FROM product_categories";
$retval = $conet->query($sql);
while ($row = $retval->fetch_assoc()) {
  $data[] = $row;
}

$sql = "SELECT  name, content,slug, thumbnail, category_id FROM posts WHERE id='$id'";
$retval = $conet->query($sql);

?>

<div class="card card-primary">
  <div class="card-header">
    <h1 class="card-title">Sửa Bài Viết</h1>
  </div>
  <form method="post" enctype="multipart/form-data">
    <div class="card-body">
      <?php
      while ($row = $retval->fetch_assoc()):
        ?>
        <div class="form-group">
          <label for="exampleInputEmail1">Tiêu đề bài biết</label>
          <input type="text" class="form-control" name="name_post" placeholder="Tiêu đề bài viết"
            value="<?= $row['name'] ?>">
        </div>
        <select class="form-select" aria-label="Default select example" name="category_id">
          <?php
          foreach ($data as $frint): ?>
            <option <?= (isset($_POST["categori"]) && $_POST["categori"] === $frint['id']) ?> value="<?= $frint['id'] ?>">
              <?= $frint['name'] ?>
            </option>
          <?php endforeach ?>
        </select>

        <div class="form-group">
          <label for="exampleInputPassword1">Luồng</label>
          <input type="text" class="form-control" name="slug" placeholder="đường dẫn" value="<?= $row['slug'] ?>">
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Nội Dung</label>
          <textarea id="summernote" name="content" value=""><?= $row['content'] ?></textarea>
        </div>

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
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Đăng</button>
      </div>
    <?php

      endwhile;
      $retval->free();
      mysqli_close($conet);
      ?>
  </form>
</div>