<?php
session_start();
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

  <title>K-Phones</title>

  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
  <link rel="stylesheet" href="assets/css/owl.css">
</head>

<body>
  <header class="">
    <? include_once 'components/header.php' ?>
  </header>


  <div class="page-heading products-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="text-content">

          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="products">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="filters">
            <h1>Cảm ơn bạn đã đặt hàng tại Wolves Phones, check mail để xem chi tiết thông tin đơn hàng của bạn </h1>
          </div>
        </div>
      </div>
    </div>
  </div>
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