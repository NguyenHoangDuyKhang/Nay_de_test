<?php
include_once 'admin/connet/connet.php';
include_once 'admin/function/function.php';
session_start();
$id_user = $_SESSION['id'] ;
$data = order($id_user);
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

  <title>Wolves Phones</title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
  <link rel="stylesheet" href="assets/css/owl.css">
</head>

<body>
  <header>
    <? include_once 'components/header.php' ?>
  </header>

  <br /><br /><br /><br /><br />
 
  <div class="latest-products">
  <h2 class="text-center" style="color: red">Đơn Hàng Của <?=$_SESSION['name']?></h2>
  <br>
    <div class="container ">
      
      <div class="row">
     
        <div class="col-md-12 container">
          <div class="card card-primary">
 
           <div class="card-body table-responsive p-0" style="height: 400px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Tên Khách Hàng</th>
                      <th>Tên Sản Phẩm</th>
                      <th>Ngày Đặt Hàng</th>
                      <th>Ảnh</th>
                      <th>Số Lượng</th>
                      <th>Tổng Tiền</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(isset($data)) :
                    ?>
                 <?php foreach($data as $thongtin) :?>
                    <tr>
                      <td> <?= $_SESSION['name'] ?> </td>
                      <td><?=$thongtin['oder_name'] ?></td>
                      <td><?=$thongtin['created_at']?></td>
                      <td> <img src="../admin/<?=$thongtin['thumbnail'] ?>" alt="" width="50"></td>
                      <td><?=$thongtin['qty']?></td>
                      <td><?=number_format($thongtin['price'] , 0, ",", ".")?>đ</td>
                    </tr>
                  </tbody>
               <?php endforeach;?>
               <?php endif;?>
                </table>
              </div>
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