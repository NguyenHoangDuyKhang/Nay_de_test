<?php
session_start();
include_once "admin/connet/connet.php";
include_once 'admin/function/function.php';
// Set thời gian ở TP Hồ Chí Minh
date_default_timezone_set('Asia/Ho_Chi_Minh');


if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}
// Them vao gio hang
if (isset($_POST['addcart'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $thumbnail = $_POST['thumbnail'];
  $price = $_POST['price'];
  $sale_price = $_POST['sale_price'];
  $qty = '1';
  $product = [
    'id' => $id,
    'name' => $name,
    'thumbnail' => $thumbnail,
    'price' => $price,
    'sale_price' => $sale_price,
    'qty' => $qty
  ];
  $found = 0;
  if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $productId) {
      if ($id == $productId['id']) {
        $_SESSION['cart']["$id"]['qty']++;
        $found = 1;
        break;
      }
    }
  }
  if (!$found) {
    $_SESSION['cart']["$id"] = $product;
  }
}

if (isset($_SESSION['cart'])) {
  if (isset($_POST['removecart'])) {
    $id = $_POST['removecart'];
    foreach ($_SESSION['cart'] as $productId) {
      if ($id == $productId['id']) {
        unset($_SESSION['cart']["$id"]);
        header('Location: card.php');
        break;
      }
    }
  }
}

if (isset($_SESSION['cart'])) {
  if (isset($_POST['editcart'])) {
    $id = $_POST['id'];
    $size = sizeof($_SESSION['cart']);
    $qtyedit = $_POST['editqty'];
    if ($qtyedit <= 0) {
      $qtyedit = 1;
    }
    for ($i = 0; $i < $size; $i++) {
      $_SESSION['cart'][$id[$i]]['qty'] = $qtyedit[$i];
    }
  }
}

if (isset($_SESSION['cart'])) {
  foreach ($_SESSION['cart'] as $gia) {
    $tong = $gia['sale_price'] * $gia['qty'];
    $tong_giam = 0;
  }
}

// này là cái giảm giá
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['giamgia'])) {
    $code = $_POST['code'];
    // Lấy cái ngày hôm nay ra
    $date = date("Y-m-d H:i:s");
    foreach ($_SESSION['cart'] as $gia) {
      $data = Getdiscount($code);
      //  tính tổng tiền hiện có
      $tong = $gia['sale_price'] * $gia['qty'];
      $tong_giam = 0;
      // Kiểm tra cái mã có tồn tại hông , cái mã nhập lên có giống hong, cái mã đó có hết hạng hong?
      foreach ($data['data'] as $info) {
        if ($data['check'] == 1) {
          echo $data['check'];
          $thongbao_code = "";
          if ($date >= $info['expiration_date']) {
            $thongbao_code = "Mã giảm giá hết thời gian sử dụng";
          } else if (1 >= $info['quantity']) {
            $thongbao_code = "Mã giảm giá đã hết";
          }
          if ($code == $info['code'] && isset($code) && $date <= $info['expiration_date'] && $info['quantity'] >= 1) {
            if ($info['discount_type'] < 100) {
              $tong_giam = ($gia['sale_price'] * $gia['qty']) * ($info['discount_type'] / 100);
              $tong = $tong - $tong_giam;
            } else if ($info['discount_type'] > 100) {
              $tong_giam = $info['discount_type'];
              $tong = $tong - $info['discount_type'];
            }
            $thongbao_code = "Mã giảm giá được áp dụng thành công";
          }
        } 
      }
      if(isset($data) && $data['check'] == 0) {
        $thongbao_code = "Mã giảm giá không tồn tại";
      }
    }
    // Cập nhật lại số lượng mã 
    $sql_discount = "UPDATE discount SET quantity = quantity - 1 WHERE code = '$code'";
    if (mysqli_query($conet, $sql_discount)) {
    } else {
      echo "Lỗi" . $sql_discount . mysqli_error($conet);
    }
  }
}
if (isset($tong)) {
  $_SESSION['tong'] = $tong;
  if ($tong_giam > 0) {
    $_SESSION['tong_giam'] = $tong_giam;
  } else {
    $_SESSION['tong_giam'] = 0;
  }
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
  <title>Wolves Phones - Card</title>

  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
  <link rel="stylesheet" href="assets/css/owl.css">

</head>

<body>
  <header class="">
    <? include_once 'components/header.php' ?>
    <div class="banner header-text">
    </div>

  </header>



  <br> <br> <br> <br> <br>
  <div class="container px-3 my-5 clearfix">
    <div class="card">
      <div class="card-header bg-primary text-light">
        <h2>Giỏ hàng</h2>
      </div>
      <div class="card-body">
        <form action="" method="post">
          <div class="table-responsive">
            <table class="table table-bordered m-0">
              <thead>
                <tr>
                  <th class="text-left py-3 px-4" style="min-width: 400px;">Thông tin chi tiết sản phẩm</th>
                  <th class="text-right py-3 px-4" style="width: 100px;">Giá</th>
                  <th class="text-right py-3 px-4" style="width: 100px;">Giá đã giảm bằng mã</th>
                  <th class="text-center py-3 px-4" style="width: 120px;">Số lượng</th>
                  <th class="text-right py-3 px-4" style="width: 100px;">Tổng</th>
                  <th class="text-center align-middle py-3 px-0" style="width: 40px;"><a href="#"
                      class="shop-tooltip float-none text-light" title="" data-original-title="Clear cart"><i
                        class="ino ion-md-trash"></i></a></th>
                </tr>
              </thead>
              <tbody>
                <?php if (isset($_SESSION['cart'])): ?>
                  <?php foreach ($_SESSION['cart'] as $gia): ?>
                    <tr>
                      <td class="p-4">
                        <div class="media align-items-center">
                          <img src=" admin/<?= $gia['thumbnail'] ?>" class="d-block ui-w-40 ui-bordered mr-4" alt=""
                            width="250px">
                          <div class="media-body">
                            <a href="#" class="d-block text-dark text-decoration-none">
                              <h2>
                                <?= $gia['name'] ?>
                              </h2>
                            </a>
                          </div>
                        </div>
                      </td>
                      <td class="text-right font-weight-semibold align-middle p-4">
                        <?= number_format($gia['sale_price'], 0, ",", ".") ?>đ
                      </td>
                      <td class="text-right font-weight-semibold align-middle p-8">
                        -
                        <?= number_format($tong_giam, 0, ",", ".") ?>đ
                      </td>
                      <td class="align-middle p-4"><input name="editqty[]" type="number" class="form-control text-center"
                          value="<?= $gia['qty'] ?>"></td>
                      <td class="text-right font-weight-semibold align-middle p-4">
                        <?= number_format($tong, 0, ",", ".") ?>đ
                      </td>
                      <td class="text-center align-middle px-0"><button type=submit name="removecart"
                          class="btn btn-outline-danger" value="<?= $gia['id'] ?>"><i
                            class="fa-solid fa-rectangle-xmark fa-beat"></i></button></td>
                      <input type="hidden" name="id[]" value="<?= $gia['id'] ?>">
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>

          <div class="d-flex flex-wrap justify-content-end align-items-center pb-4">
            <div class="d-flex gap-4">
              <div class="text-right mt-4 mr-5">
                <div style="color: blue;">
                <?php
                if (isset($thongbao_code)) {
                  echo $thongbao_code;
                }
                ?>
                </div>
              </div>

              <div class="text-right mt-4">
                <label class="text-muted font-weight-normal">Tổng</label>
                <div class="text-large"><strong>
                    <?= isset($tong) ? (number_format($tong, 0, ",", ".")) : "" ?>đ
                  </strong></div>
              </div>
            </div>
          </div>

          <a href="products.php" class="text-decoration-none text-dark">Quay lại trang sản phẩm</a>
          <div class="float-right">

            <div class="btn btn-lg mt-2 mx-2 float-end">
              <input type="text" class="form-control my-2" name="code" id="code" value="" placeholder="Mã Giảm Giá">
            </div>

            <button type="submit" name="giamgia" class="btn btn-lg btn-primary mt-2 mx-2 float-end">Áp dụng</button>
            <a href="Pay.php" class="btn btn-lg btn-success mt-2 float-end">Thanh toán</a>
            <button type="submit" name="editcart" class="btn btn-lg btn-primary mt-2 mx-2 float-end">Cập nhập</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <?php include_once "components/footer.php"; ?>
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