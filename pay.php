<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
include_once "admin/connet/connet.php";
include_once "config/email.php";
include_once 'admin/function/function.php';
// echo $_SESSION['tong_giam'];
// LÔI CÁI SESSION RA
if (isset($_SESSION['cart'])){
  foreach ($_SESSION['cart'] as $gia){
    $tong = $gia['sale_price'] * $gia['qty'];
    $tong_giam = 0;
  }
}
  // này là cái giảm giá
if (isset($_SESSION['cart']) && isset($code)) {
    foreach ($_SESSION['cart'] as $gia) {
      $data = Getdiscount($code);
      //  tính tổng tiền hiện có
      $tong = $gia['sale_price'] * $gia['qty'];
      // Kiểm tra cái mã có tồn tại hông , cái mã nhập lên có giống hong, cái mã đó có hết hạng hong?
      foreach ($data as $discount) {
          if ($discount['discount_type'] < 1) {
            $tong_giam = ($gia['sale_price'] * $gia['qty']) * $discount['discount_type'];
            $tong = $tong - $tong_giam;
          } else if ($discount['discount_type'] > 1) {
            $tong_giam = $discount['discount_type'];
            $tong = $tong - $discount['discount_type'];
          }
        }
      }
      
    }

$name = "";
$address = "";
$phone = "";
$email = "";
// Biến dưới này lưu thông tin sản phẩm
$subtotal_product = "";
if (isset($_SESSION['email']) && isset($_SESSION['name'])) {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Pay'])) {
      $name = $_POST['kh_ten'];
      $address = $_POST['kh_diachi'];
      $phone = $_POST['kh_dienthoai'];
      $email = $_POST['kh_email'];
      $data_user = "INSERT INTO orders(customer_name, customer_phone,customer_email,address_nguoimua, total)
        VALUES('$name', '$phone', '$email','$address',$tong)";

      if ($conet->query($data_user) === TRUE) {

      } else {
        echo "Lỗi {$data_user}" . $conet->connect_error;
      }
      $sql = "SELECT max(id) as id_oder FROM orders";
      $retval = $conet->query($sql);
      $row = $retval->fetch_assoc();
      $id_oder = $row['id_oder'];
      $id_user = $_SESSION['id'];
      foreach ($_SESSION['cart'] as $item) {
        $name_pro = $item['name'];
        $thumbnail = $item['thumbnail'];
        $price = $item['sale_price'];
        $qty = $item['qty'];
        $total1 = $price * $qty;
        $data_oder = "INSERT INTO order_detail(order_id,qty,price,oder_name,thumbnail,order_user)
        VALUES($id_oder, $qty, $tong,'$name_pro','$thumbnail',$id_user)";
        if ($conet->query($data_oder) === TRUE) {
        } else {
          echo "Lỗi {$data_oder}" . $conet->connect_error;
        }
      }
    }
  }




  if (isset($_POST['Pay'])) {
    $name = $_POST['kh_ten'];
    $address = $_POST['kh_diachi'];
    $phone = $_POST['kh_dienthoai'];
    $email = $_POST['kh_email'];
    $total = $_SESSION['tong'];
    $giamgia = $_SESSION['tong_giam'];
    $ngaydat = $date = date("Y-m-d H:i:s");
    $title = "Đơn hàng của bạn từ cửa hàng K-Phones";
    $content = "
    <h3>Thông tin khách hàng</h3>
    <p><b>Tên khách hàng:</b> " . $name . " </p>
    <p><b>Sđt:</b> " . $phone . " </p>
    <p><b>Email:</b> " . $email . " </p>
    <p><b>Địa chỉ:</b> " . $address . " </p>
    <p><b>Ngày đặt hàng:</b> " . $ngaydat . " </p>
    </hr>
    <h3>THÔNG TIN ĐƠN HÀNG </h3>
    ";
foreach ($_SESSION['cart'] as $cart) {
$content .= "
<p>" . $cart['name'] . "<b> x " . $cart['qty'] . "</b> --> " . number_format(($cart['sale_price'] * $cart['qty']), 0, '.', ',') . " VNĐ</p> 
";
$tongprice = ($cart['sale_price'] * $cart['qty']);
}
$content .= "
<h4>Tổng thành tiền " . number_format($total) . " VNĐ</h4>";
    guimail($email, $title, $content);
  }

  // Gửi mail về admin
  if (isset($_POST['Pay'])) {
    $name = $_POST['kh_ten'];
    $address = $_POST['kh_diachi'];
    $phone = $_POST['kh_dienthoai'];
    $email = $_POST['kh_email'];
    $total = $_SESSION['tong'];
    $giamgia = $_SESSION['tong_giam'];
    $ngaydat = $date = date("Y-m-d H:i:s");
    $title = "Thông tin đơn hàng mới của khách hàng";
    $content = "
          <h3>Thông tin khách hàng</h3>
          <p><b>Tên khách hàng:</b> " . $name . " </p>
          <p><b>Sđt:</b> " . $phone . " </p>
          <p><b>Email:</b> " . $email . " </p>
          <p><b>Địa chỉ:</b> " . $address . " </p>
          <p><b>Ngày đặt hàng:</b> " . $ngaydat . " </p>
          </hr>
          <h3>THÔNG TIN ĐƠN HÀNG </h3>
          ";
    foreach ($_SESSION['cart'] as $cart) {
      $content .= "
      <p>" . $cart['name'] . "<b> x " . $cart['qty'] . "</b> --> " . number_format(($cart['sale_price'] * $cart['qty']), 0, '.', ',') . " VNĐ</p> 
      ";
      $tongprice = ($cart['sale_price'] * $cart['qty']);
    }
    $content .= "
  <h4>Tổng thành tiền " . number_format($total) . " VNĐ</h4>";
    guimail_admin($content);
  }

} else {
  echo "<script>
  alert('VUI LÒNG ĐĂNG NHẬP ĐỂ THANH TOÁN!') ;
  </script>";
  exit;
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
  <title>Wolves Phones - Pay</title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


  <!-- Additional CSS Files -->
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
  <div class="container mt-4 my-5">
    <div class="py-5 text-center"> 
      <i class="fa fa-credit-card fa-4x" aria-hidden="true"></i>
      <h2>Thanh toán</h2>
      <p class="lead">Vui lòng kiểm tra thông tin Khách hàng, thông tin Giỏ hàng trước khi Đặt hàng.</p>
    </div>

    <div class="row">
      <div class="col-md-4 order-md-8 mb-8 container">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span>Giỏ hàng</span>
        </h4>
        <?php if (isset($_SESSION['cart'])): ?>
          
          <?php foreach ($_SESSION['cart'] as $item): ?>
            <ul class="list-group mb-3">
              <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                  <h6 class="my-0">Tên</h6>
                  <span>
                    <?= $item['name'] ?>
                  </span>
                </div>
              </li>
              <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                  <h6 class="my-0">Ảnh</h6>
                  <span> <img src="admin/<?= $item['thumbnail'] ?>" width="150px">
                  </span>
                </div>
              </li>
              <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                  <h6 class="my-0">Giá (Mỗi sản phẩm)</h6>
                  <span>
                    <?= number_format( $item['sale_price'], 0, ",", ".") ?>đ
                  </span>
                </div>
              </li>
              <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                  <h6 class="my-0">Số lượng</h6>
                  <span>
                    <?= $item['qty'] ?>
                  </span>
                </div>
              </li>
              <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                  <h6 class="my-0">Giá (tổng)</h6>
                  <span>
                    <?= number_format( $item['sale_price'] * $item['qty'], 0, ",", ".") ?>đ
                  </span>
                </div>
              </li>

              <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                  <h6 class="my-0">Giá (Giảm bằng mã)</h6>
                  <span>
                    <?=number_format($_SESSION['tong_giam'] , 0, ",", ".") ?>đ
                  </span>
                </div>
              </li>
              
              <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div class=""></div>
                <div class=""></div>
              </li>
              <li class="list-group-item d-flex justify-content-between">
                <span style="color: red">Tổng thành tiền</span>
                <strong>
                  <?= number_format($_SESSION['tong'], 0, ",", ".") ?>đ
                </strong>
              </li>
            </ul>

          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
    <form action="" method="post">
      <div class="col-md-8 order-md-4 container ">
        <br><br>
        <h4 class="mb-3 text-center">Thông tin khách hàng</h4>
        <div class="row">
          <div class="col-md-12">
            <label for="kh_ten">Họ tên*</label>
            <input type="text" class="form-control my-2" name="kh_ten" id="kh_ten" value="" placeholder="Họ và tên"
              required="">
          </div>
          <div class="col-md-12">
            <label for="kh_diachi">Địa chỉ*</label>
            <input type="text" class="form-control my-2" name="kh_diachi" id="kh_diachi" value="" placeholder="Địa chỉ"
              required="">
          </div>
          <div class="col-md-12">
            <label for="kh_dienthoai">Số Điện thoại*</label>
            <input type="text" class="form-control my-2" name="kh_dienthoai" id="kh_dienthoai" value=""
              placeholder="SDT" required="">
          </div>
          <div class="col-md-12">
            <label for="kh_email">Email*</label>
            <input type="text" class="form-control my-2" name="kh_email" id="kh_email" value="" placeholder="Email"
              required="">
          </div>

          
        </div>

        <h4 class="mb-3">Hình thức thanh toán*</h4>
        <div class="d-block my-3">
          <div class="custom-control custom-radio">
            <input id="httt-2" name="httt_ma" type="radio" class="custom-control-input" required="" value="2">
            <label class="custom-control-label" for="httt-2">Chuyển khoản</label>
          </div>
          <div class="custom-control custom-radio">
            <input id="httt-3" name="httt_ma" type="radio" class="custom-control-input" required="" value="3">
            <label class="custom-control-label" for="httt-3">Ship COD</label>
          </div>
        </div>
        <hr class="mb-4">
        <button class="btn btn-success" type="submit" name="Pay">Đặt hàng</button>
      </div>
    </form>







    <?php
    include_once "components/footer.php";
    ?>


    <script src="vendor/jquery/jquery.min.js"></scrip >
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/accordions.js"></script>


    <script language="text/Javascript">
                                                  cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
                                                  function clearField(t){                   //declaring the array outside of the
      if(! cleared[t.id]){                      // function makes it static and global
                                                    cleared[t.id] = 1;  // you could use true and false, but that's more typing
                                                  t.value='';         // with more chance of typos
                                                  t.style.color='#fff';
          }
      }
    </script>


</body>

</html>