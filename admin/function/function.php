<?php
// Lấy Sản phẩm cần edit
function Getedit_pro($id)
{
  global $conet;
  $sql = "SELECT * FROM products WHERE id = $id";
  $retval = $conet->query($sql);
  while ($row = $retval->fetch_assoc()) {
    $data[] = $row;
  }
  return $data;
}


function GetAllpro()
{
  global $conet;
  $sql = "SELECT * FROM products ORDER BY id DESC";
  $retval = $conet->query($sql);
  while ($row = $retval->fetch_assoc()) {
    $data[] = $row;
  }
  return $data;
}

// Lấy ra cái danh mục
function Get_product_categories()
{
  global $conet;
  $sql = "SELECT * FROM product_categories";
  $retval = $conet->query($sql);
  while ($row = $retval->fetch_assoc()) {
    $data[] = $row;
  }
  return $data;
}


function GetCount($conet, $table)
{
  $sql = "SELECT COUNT(*) as count
    FROM $table";
  $retval = $conet->query($sql);
  $row = $retval->fetch_assoc();
  return $row['count'];
}

function GetProductByCategori($id)
{
  global $conet;
  $sql = "SELECT id , name, content, price, sale_price,capacity, thumbnail FROM products WHERE category_id = '$id'";
  $retval = $conet->query($sql);
  while ($row = $retval->fetch_assoc()) {
    $data[] = $row;
  }
  return $data;
}

// Này Dùng để lặp ra cái danh mục
function GetDataPage($conet, $table, $offset, $limit)
{
  $data = [];
  $sql = "SELECT * FROM $table LIMIT $offset, $limit ";
  $retval = $conet->query($sql);
  while ($row = $retval->fetch_assoc()) {
    $data[] = $row;
  }
  return $data;
}

//TÌM KIẾM THEO TÊN
function timkiem($conet, $timkiem)
{
  $data = NULL;
  $sql = "SELECT * FROM products WHERE name LIKE '%".$timkiem."%' ";
  $retval = $conet->query($sql);
  while ($row = $retval->fetch_assoc()) {
    $data[] = $row;
  }
  return $data;
}

// Truy vấn cái danh mục theo tên danh mục
function loctheodanhmuc($tendanhmuc){
  global $conet;
  $sql = "SELECT product_categories.name ,  products.id ,products.name , products.sale_price , products.price, products.content	, products.view, products.thumbnail
  FROM products JOIN product_categories ON products.category_id = product_categories.id WHERE product_categories.name = '$tendanhmuc'";
  $retval = $conet->query($sql);
  while ($row = $retval->fetch_assoc()) {
    $data[] = $row;
  }
  return $data;
}

function GetCategory()
{
  global $conet;
  $sql = "SELECT id, name, content FROM product_categories";
  $retval = $conet->query($sql);
  while ($row = $retval->fetch_assoc()) {
    $data[] = $row;
  }
  return $data;
}

function upload($uploadedFile)
{
  $imagePath = "";
  if (isset($uploadedFile)) {
    // Kiểm tra xem có lỗi xảy ra không
    if ($uploadedFile['error'] === UPLOAD_ERR_OK) {
      $tempName = $uploadedFile['tmp_name'];
      // Xác định tên file mới
      $originalName = basename($uploadedFile['name']);
      $extension = pathinfo($originalName, PATHINFO_EXTENSION);
      $newFileName = uniqid() . '_' . $originalName; // Thêm một giá trị duy nhất vào tên file
      // Thư mục lưu trữ ảnh
      $uploadDir = 'img/';
      // Di chuyển file ảnh đến thư mục lưu trữ
      if (move_uploaded_file($tempName, $uploadDir . $newFileName)) {
        // Trả về đường dẫn ảnh mới
        $imagePath = $uploadDir . '/' . $newFileName;
      } else {
        echo "Có lỗi xảy ra khi lưu trữ file ảnh.";
      }
    } else {
      echo "Có lỗi xảy ra trong quá trình upload ảnh. <br>";
    }
  }
  return $imagePath;
}

// Xem đơn hàng ở trang người dùng
function order($id_user)
{
  global $conet;
  $sql = "SELECT * FROM order_detail WHERE order_user = '$id_user'";
  $retval = $conet->query($sql);
  while ($row = $retval->fetch_assoc()) {
    $data[] = $row;
  }
  if (isset($data)) {
    return $data;
  }
}

// SẢN PHẨM TƯƠNG TỰ
function related_products($category_id)
{
  global $conet;
  $sql = "SELECT * FROM products WHERE category_id = $category_id";
  $retval = $conet->query($sql);
  while ($row = $retval->fetch_assoc()) {
    $data[] = $row;
  }
  return $data;
}

//MÃ GIẢM GIÁ
function Getdiscount($code)
{
  global $conet;
  $sql = "SELECT * FROM discount WHERE code = '$code'";
  $retval = $conet->query($sql);
  while ($row = $retval->fetch_assoc()) {
    $data[] = $row;
  }

  if (isset($data) && $data != NULL) {
    return [
      'check' => 1,
      'data' => $data
    ];
  } else {
    return [
      'check' => 0,
      'data' => $data = []
    ];
  }
}

// Lấy top 10 sản phẩm có lượt xem nhiều nhất
function Get_top10_view(){
global $conet;
$sql_top10 = "SELECT id, name, thumbnail FROM products ORDER BY view DESC LIMIT 10";
$retval = $conet->query($sql_top10);
while ($row = $retval->fetch_assoc()) {
  $data[] = $row;
}
return $data;
}

// Lọc theo Sản phẩm có giá từ cao đên thấp
function Get_Max_price(){
  global $conet;
  $sql = "SELECT * FROM products ORDER BY sale_price DESC";
  $retval = $conet->query($sql);
  while ($row = $retval->fetch_assoc()) {
  $data[] = $row;
}
  return $data;
}

// Lọc theo Sản phẩm có giá từ thấp đên cao
function Get_Min_price(){
  global $conet;
  $sql = "SELECT * FROM products ORDER BY sale_price ASC";
  $retval = $conet->query($sql);
  while ($row = $retval->fetch_assoc()) {
  $data[] = $row;
}
  return $data;
}

// Lọc theo sản phẩm mới nhất
function Get_data_new(){
  global $conet;
  $sql = "SELECT * FROM products ORDER BY created_at DESC";
  $retval = $conet->query($sql);
  while ($row = $retval->fetch_assoc()) {
  $data[] = $row;
}
  return $data;
}


// Lọc theo sản phẩm cũ nhất
function Get_data_old(){
  global $conet;
  $sql = "SELECT * FROM products ORDER BY created_at ASC";
  $retval = $conet->query($sql);
  while ($row = $retval->fetch_assoc()) {
  $data[] = $row;
}
  return $data;
}

  ?>