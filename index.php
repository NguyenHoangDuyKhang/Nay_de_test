<?php
session_start();
include_once 'admin/connet/connet.php';
include_once 'admin/function/function.php';
$products =GetAllpro();
$Signin = 'Sign in';
$account = 'My account';
if (isset($_SESSION['email']) && isset($_SESSION['name'])) {
  $hienthi = $account;
} else {
  $hienthi = $Signin;
}
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Wolves Phones - Home</title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
  <link rel="stylesheet" href="assets/css/owl.css">

</head>
<body>
  <header>
    <?php include_once 'components/header.php' ?>
  </header>
  <div class="banner header-text">
  </div>


  <div class="latest-products">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>Sản phẩm mới nhất</h2>
            <a href="products.php">Xem tất cả sản phẩm <i class="fa fa-angle-right"></i></a>
          </div>
        </div>

        <?php if (isset($products)): ?>
          <?php foreach ($products as $product): ?>
            <div class="col-md-4">
              <div class="product-item">
                <a href="chitiet.php/?id=<?= $product['id'] ?>"><img src="admin/<?= $product['thumbnail'] ?>" alt=""
                    width="200px" height="350px"></a>
                <div class="down-content">
                  <a href="#">
                    <h4>
                      <?= $product['name'] ?>
                    </h4>
                  </a>
                  <h4><del><b>Giá:
                        <?= number_format($product['price'], 0, ",", ".") ?>đ
                      </b></del></h4>
                  <h4>Giá Giảm:
                    <?= number_format($product['sale_price'], 0, ",", ".") ?>đ
                  </h4>
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
            </div>
            <?php
          endforeach;
          ?>
        <?php endif; ?>
        <?php mysqli_close($conet) ?>
      </div>
    </div>
  </div>
  <?php
  include_once "components/footer.php";
  ?>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/custom.js"></script>
  <script src="assets/js/owl.js"></script>
  <script src="assets/js/slick.js"></script>
  <script src="assets/js/isotope.js"></script>
  <script src="assets/js/accordions.js"></script>


  <script language="text/Javascript">
    cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
    function clearField(t) {                   //declaring the array outside of the
      if (!cleared[t.id]) {                      // function makes it static and global
        cleared[t.id] = 1;  // you could use true and false, but that's more typing
        t.value = '';         // with more chance of typos
        t.style.color = '#fff';
      }
    }
  </script>


</body>

</html>