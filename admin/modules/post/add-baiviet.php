<?php
include_once 'connet/connet.php';
include_once "function/function.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $name = $_POST['name-post'];
  $content = $_POST['content'];
  $slug = $_POST['slug'];
  $category_id	= $_POST['category_id'];
  $thumbnail = upload($_FILES['thumbnail']);
        if (!empty($thumbnail)) {
            echo "Tệp tin đã được tải lên thành công. Đường dẫn: " . $thumbnail;
        };

  $add_post = "INSERT INTO posts (name , content, slug , thumbnail, category_id) 
    VALUES ('$name', '$content', '$slug','$thumbnail', '$category_id')";

    if($conet->query($add_post)===TRUE){
      echo "Lưu dữ liệu thành công";
    } 
    else {
      echo "Lỗi {$add_post}" .$conet->connect_error;
    }
} else{
  echo "Vui lòng nhập đầy đủ dữ liệu của Bài Viết!";
}
$sql = "SELECT * FROM product_categories";
$retval = $conet->query($sql);
while( $row = $retval->fetch_assoc()){
  $data[] = $row;
}

mysqli_close($conet); 
?>


<div class="card card-primary">
              <div class="card-header">
                <h1 class="card-title">Thêm Bài Viết</h1>
              </div>
              <form method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tiêu đề bài biết</label>
                    <input type="text" class="form-control" name="name-post" placeholder="Tiêu đề bài viết">
                  </div>

                  <select class="form-select" aria-label="Default select example"  name="category_id">
        <?php
        foreach($data as $frint) :?>
             <option <?= (isset($_POST["categori"]) && $_POST["categori"] ===  $frint['id'] )?>  value="<?= $frint['id']?>"> <?= $frint['name'] ?> </option>
        <?php endforeach?>
      
      </select>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Luồng</label>
                    <input type="text" class="form-control" name="slug" placeholder="đường dẫn">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputPassword1" >Nội Dung</label>
                    <textarea id="summernote" name="content" ></textarea>
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
              </form>
            </div>