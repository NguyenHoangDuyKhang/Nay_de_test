<?php
include_once 'connet/connet.php';
// include_once "function/function.php";
if (isset($_GET["id"])) {
  $id = $_GET['id'];
//Lấy thông tin người dùng
$sql_oder = "SELECT * FROM orders WHERE id = '$id'";
$result = mysqli_query($conet, $sql_oder);
$khachhang = mysqli_fetch_all($result, MYSQLI_ASSOC);
// lấy thông tin đơn hàng
$sql_oder_det = "SELECT * FROM order_detail WHERE order_id = '$id'";
$result = mysqli_query($conet, $sql_oder_det);
$donhang = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

?>

<script src="https://kit.fontawesome.com/55f801a73d.js" crossorigin="anonymous"></script>
<div class="row">
<div class="col-12">
<hr>
<h2 class="text-center">CHI TIẾT ĐƠN HÀNG</h2>
<hr>
<div class="col-12">
  <div class="callout callout-info">
    <h5><i class="fas fa-info"></i> Ghi chú:</h5>
    Trang này đã được tăng cường để in. Nhấn vào nút in ở cuối hóa đơn để kiểm tra.
  </div>

  <!-- Main content -->
  <div class="invoice p-3 mb-3">
    <!-- title row -->
  <?php foreach($khachhang as $user): ?>
    <div class="row">
      <div class="col-12">
        <h4><i class="fas fa-globe"></i> Thông tin khách hàng</h4>
        <h4>
          <small class="float-right">Ngày: <?=$user['created_at'] ?></small>
        </h4>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        <b>Từ</b>
        <address> 
          Ấp Ba Ngàn A - Xã Đại Thành - 
          <br>
         Thành Phố Ngã Bảy - Tỉnh Hậu Giang<br>
          Điện thoại: 0365850920<br>
          Email: khang12a3lqd@gmail.con
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Đến</b>
        <address>
          <?= $user['address_nguoimua'] ?> <br>
          Điện thoại: <?= $user['customer_phone'] ?? '' ?><br>
          Email: <?= $user['customer_email'] ?? '' ?> <br>
          Tên người nhận: <?= $user['customer_name'] ?? '' ?>
        </address>
      </div>
    
    
      <div class="col-sm-4 invoice-col">
        <b>Hóa đơn</b><br>
        <b>ID hóa đơn: </b><?= $user['id'] ?? '' ?><br>
        <b>Hạn thanh toán:</b> <?= $user['created_at'] ?><br>
        <b>Tổng tiền:</b> <?= number_format($user['total'],0,",",".") ?? '' ?>đ<br>
      </div>
    </div>
    <?php endforeach ?>
  
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Hình Ảnh</th>
              <th>Tên Sản Phẩm</th>
              <th>Số Lượng</th>
              <th>Tổng Tiền</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach($donhang as $dh): ?>
            <tr>
            <td><img src="<?=$dh['thumbnail']?>"  width="80" alt=""></td>
              <td><?= $dh['oder_name'] ?></td>
              <td><?= $dh['qty'] ?></td>
              <td><?= number_format($dh['price'],0,",",".") ?? '' ?>đ</td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
</div>

    </div>
    <div class="row no-print">
      <div class="col-12">
        <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> In</a>
        <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
          <i class="fas fa-download"></i> Tải PDF
        </button>
        <td><a href="?action=order_detail"><button type="button" class="btn btn-outline-primary"> <i class="fa-solid fa-pen-to-square fa-shake"></i>
             Xem đơn hàng</button></a></td>
                    </tr>
                  </tbody>
      </div>
    </div>
  </div>
</div>
