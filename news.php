<?php
include_once 'admin/function/function.php';
include_once 'admin/connet/connet.php';
session_start();
$query = "SELECT posts.id, posts.name, posts.content, posts.thumbnail, posts.content 
        FROM posts
        ORDER BY posts.id DESC";
// Thực hiện câu lệnh query
$result = mysqli_query($conet, $query);
// Lưu kết quả thành một mảng
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);
// Kiểm tra kết quả
if (!$result) {
  die("Lỗi truy vấn: " . mysqli_error($conet));
}

$sql = "SELECT id , name, content,slug, thumbnail FROM posts";
$retval = $conet->query($sql);
include_once "admin/function/function.php";
$count = GetCount($conet, 'posts');


// Số lượng bản ghi hiển thị trên mỗi trang
$totalRecords = $count;
$recordsPerPage = 2;
// Trang hiện tại (nếu không được xác định, mặc định là trang 1)
$current_page = isset($_GET['page-item']) ? $_GET['page-item'] : 1;
// Tính số lượng trang cần hiển thị
$totalPages = ceil($totalRecords / $recordsPerPage);
// Giới hạn giá trị trang hiện tại trong khoảng từ 1 đến tổng số trang
$current_page = max(1, min($current_page, $totalPages));
// Tính vị trí bắt đầu lấy dữ liệu từ CSDL
$startFrom = ($current_page - 1) * $recordsPerPage;
$bientam = GetDataPage($conet, 'products', $startFrom, $recordsPerPage);
?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
    rel="stylesheet">
    <script src="https://kit.fontawesome.com/55f801a73d.js" crossorigin="anonymous"></script>
  <title>Wolves Phones - News</title>

  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
  <link rel="stylesheet" href="assets/css/owl.css">

</head>

<body>
  <header class="">
    <? include_once 'components/header.php' ?>
  </header>


  <div class="banner header-text">
  </div>
  <div class="products">
    <div class="container">
      <div class="row">
        <?php if (isset($products)): ?>
          <?php foreach ($products as $product): ?>
            <div class="col-lg-4 col-md-4 all des">
              <form action="card.php" method="post">
                <div class="product-item">
                  <a href="#"><img src="admin/<?= $product['thumbnail'] ?>" alt="" width="200px" height="360px"></a>
                  <div class="down-content">
                    <a href="#">
                      <h4>
                        <?= $product['name'] ?>
                      </h4>
                    </a>
                    <p>
                      <?= $product['content'] ?>
                    </p>
                    <ul class="stars">
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                    </ul>

                  </div>
                </div>
              </form>
            </div>

          <?php endforeach; ?>
        <?php endif; ?>
        <?php mysqli_close($conet) ?>

        <?php
        include_once "components/footer.php";
        ?>


        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


        <!-- Additional Scripts -->
        <script src="assets/js/custom.js"></script>
        <script src="assets/js/owl.js"></script>
        <script src="assets/js/slick.js"></script>
        <script src="assets/js/isotope.js"></script>
        <script src="assets/js/accordions.js"></script>


        <script language="text/Javascript">
          cleared[0] = cleared[1] = cleared[2] = 0;
          function clearField(t) {
            if (!cleared[t.id]) {
              cleared[t.id] = 1;
              t.value = '';
              t.style.color = '#fff';
            }
          }
        </script>


</body>

</html>