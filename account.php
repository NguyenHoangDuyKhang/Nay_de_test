<?php
include_once 'admin/connet/connet.php';
include_once 'admin/function/function.php';
session_start();
$Signin = 'Sign in';
$account = 'My account';
if (isset($_SESSION['email']) && isset($_SESSION['name'])) {
    $hienthi = $account;
} else {
    $hienthi = $Signin;
}
//Hiển thị người dùng là ai
$sql = "SELECT * FROM users WHERE email = '$_SESSION[email]' ";
$retval = $conet->query($sql);
$row = $retval->fetch_assoc();
$chuc_vu = "";
if($row['role'] == 1){
    $chuc_vu = "Admin";
} else {
    $chuc_vu = "Người dùng";
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

    <title>Wolves Phones - Home</title>
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

    <div class="banner header-text ">
    </div>
    <div class="products">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 all des">
                    <div class="card" style="width: 20rem;">
                        <div class="card-body">
                            <h5 class="card-title">TÀI KHOẢNG CỦA TÔI</h5>
                            <img src="https://hienthao.com/wp-content/uploads/2023/05/c6e56503cfdd87da299f72dc416023d4-736x620.jpg"
                                alt="" width="60px">
                            </br></br>
                            <p class="card-text">
                            <h6>Tên:
                                <?= $_SESSION['name'] ?>
                            </h6>
                            </p>

                            <p class="card-text">
                            <h6>Email:
                                <?= $_SESSION['email'] ?>
                            </h6>
                            </p>
                            <p class="card-text">
                            <h6>Chức Vụ:
                                <?php
                                if(isset($chuc_vu)){
                                    echo $chuc_vu;
                                }?>
                                 </h6>
                            </p>
                            <a href="logout.php" class="card-link">ĐĂNG XUẤT</a>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 col-md-4 all des">
                    <div class="card" style="width: 20rem;">
                        <div class="card-body">
                            <a href="update_acc.php" class="card-link">CẬP NHẬT TÀI KHOẢN</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 all des">
                    <div class="card" style="width: 20rem;">
                        <div class="card-body">
                            <a href="my_order.php" class="card-link">ĐƠN HÀNG CỦA BẠN</a>
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