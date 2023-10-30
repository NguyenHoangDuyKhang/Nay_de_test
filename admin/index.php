<?php
session_start();
include "connet/connet.php";
$sql = "SELECT * FROM users WHERE email = '$_SESSION[email]'";
$retval = $conet->query($sql);
$row = $retval->fetch_assoc();
if (!isset($_SESSION['admin'])) {
  header("Location: http://asm/admin/login_admin.php");
} else {
  $user = $_SESSION['user'][1];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <?php
  include 'components/stylesheet.php';
  include_once 'function/function.php';
  ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <?php
    include 'components/navbar.php';
    ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->

    <!-- Sidebar -->
    <?php
    include 'components/sideber.php';
    ?>
    <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">
                <?= $row['name'] ?>
              </h1>

            </div><!-- /.col -->

            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">

              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->


          <?php
          switch ($_GET['action']) {
            case 'dashboard':
              include_once 'dashboard.php';
              break;

            case 'card';
              include 'client/card.php';
              break;

            case 'card-products';
              include 'client/card-products.php';
              break;

            case 'pay';
              include 'client/pay.php';
              break;

            case 'statistical';
              include 'thongke_bieudo.php';
              break;

            case 'statistical_tb';
              include 'thongke_table.php';
              break;

            case 'user':
              include 'modules/User-Administration/User_Administration.php';
              break;

            case 'order_detail':
              include 'modules/User-Administration/order_detail.php';
              break;

            case 'order':
              include 'modules/User-Administration/oder.php';
              break;

            case 'comment':
              include 'modules/User-Administration/comment.php';
              break;

              case 'add_user':
                include 'modules/User-Administration/add_user.php';
                break;

            case 'discount':
              include 'modules/User-Administration/discount_code.php';
              break;

            case 'edit_discount':
              include 'modules/User-Administration/edit_discount.php';
              break;

            case 'danhsach_discount':
              include 'modules/User-Administration/danhsach_discount.php';
              break;
              
              case 'info';
                  include 'info/my_admin.php';
                  break;

                  case 'update_info';
                  include 'info/update_admin.php';
                  break;


            default:
              include '404.php';
              break;

            case 'post':
              switch ($_GET["add"]) {
                case 'add-baiviet';
                  include 'modules/post/add-baiviet.php';
                  break;

                case 'danhsachbaiviet';
                  include 'modules/post/danh-sach-bai-viet.php';
                  break;

                case 'edit-baiviet';
                  include 'modules/post/edit-baiviet.php';
                  break;
              }

            case 'oder':
              switch ($_GET["add"]) {
                case 'add-sanpham';
                  include 'modules/oder/add-sanpham.php';
                  break;

                case 'edit-sanpham';
                  include 'modules/oder/edit-sanpham.php';
                  break;

                case 'danhsachsanpham';
                  include 'modules/oder/danh-sach-san-pham.php';
                  break;

                  case 'bienthe';
                  include 'modules/oder/sanpham_bienthe.php';
                  break;
              }
          }
          ?>
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <?php
    // include 'components/fooder.php';
    ?>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  <?php
  include 'components/script.php';
  ?>
  <!-- jQuery -->

  <script>
    $(function () {
      // Summernote
      $('#summernote').summernote()

      // CodeMirror
      CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
        mode: "htmlmixed",
        theme: "monokai"
      });
    })
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script>
</body>

</html>