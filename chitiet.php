<?php
session_start();
include_once 'admin/connet/connet.php';
include_once 'admin/function/function.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = $id";
    $retval = $conet->query($sql);
    $row = $retval->fetch_assoc();
}

// CẬP NHẬT LƯỢT VIEW
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_updat_view = "UPDATE products SET view = view + 1 WHERE id = $id";
    if (mysqli_query($conet, $sql_updat_view)) {
    } else {
        echo "Lỗi" . $sql_updat_view . mysqli_error($conet);
    }
}


// Chức năng sản phẩm có liên quan
if (isset($_GET['id'])) {
    $sql = "SELECT * FROM products WHERE id = $id";
    $retval = $conet->query($sql);
    $row = $retval->fetch_assoc();
    $category_id = $row['category_id'];
    $sanphamtuongtu = related_products($category_id);
}
// chức năng comment
$name_comment = "";
$content = "";
$ngaydang = "";
$id_pro = "";
if (isset($_SESSION['name']) && isset($_SESSION['email'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name_comment = $_SESSION['name'];
        $content = $_POST['comment'];
        $id_user = $_SESSION['id'];
        $id_pro = $_GET['id'];
        $data_comment = "INSERT INTO comment (name, content, id_user, id_pro) VALUES ('$name_comment','$content',$id_user,$id_pro)";
        if ($conet->query($data_comment) === TRUE) {
            echo "<script>
            alert('Bình luận đã được thêm thành công') ;
            </script>";
        } else {
            echo "Lỗi {$data_comment}" . $conet->connect_error;
        }
    }
} else {
    $canhbao = "VUI LÒNG ĐĂNG NHẬP ĐỂ CÓ THỂ BÌNH LUẬN";
}

$query = "SELECT users.name as username, comment.content as content, comment.ngaydang as ngay
FROM users JOIN comment ON users.id = comment.id_user JOIN products ON products.id = comment.id_pro
WHERE products.id = $id";
// Thực hiện câu lệnh query
$result = mysqli_query($conet, $query);
// Lưu kết quả thành một mảng
$comment = mysqli_fetch_all($result, MYSQLI_ASSOC);
// Kiểm tra kết quả
if (!$result) {
    die("Lỗi truy vấn: " . mysqli_error($conet));
}

if (!isset($row)) {
    echo "Sản phẩm này không tồn tại";
} else {
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
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Additional CSS Files -->
        <link rel="stylesheet" href="../assets/css/fontawesome.css">
        <link rel="stylesheet" href="../assets/css/templatemo-sixteen.css">
        <link rel="stylesheet" href="../assets/css/owl.css">

    </head>

    <body>
        <header>
            <? include_once 'components/header.php' ?>
        </header>

        <div class="banner header-text">

        </div>

        <div class="products">
            <div class="container">
                <div class="row">
                    <form action="../card.php" method="POST">
                        <div class="col-lg all des">
                            <div class="card text-center" style="width: 70rem;">
                                <div class="card-body">
                                    <img src="../admin/<?= $row['thumbnail'] ?>" alt="" width="360px">
                                    <br>
                                    <h3 class="card-title" style="color:#1a6692;">
                                        <?= strtoupper($row['name']) ?>
                                    </h3>
                                    <br />
                                    <del>
                                        <h5 class="card-title">Giá:
                                            <?= number_format($row['price'], 0, ",", ".") ?>đ
                                        </h5>
                                    </del>
                                    <h5 class="card-title" style="color: #FF0000;">Giá Giảm:
                                        <?= number_format($row['sale_price'], 0, ",", ".") ?>đ
                                    </h5>
                                    <br />

                                    <p class="card-text " style="color: #000022; font-size: 25px; line-height: 30px;">
                                        <?= $row['content'] ?>
                                    </p>
                                    <br /> <br />
                                    <button type="submit" class="btn btn-primary" name="addcart">Thêm vào giỏ hàng</button>
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <input type="hidden" name="thumbnail" value="<?= $row['thumbnail'] ?>">
                                    <input type="hidden" name="name" value="<?= $row['name'] ?>">
                                    <input type="hidden" name="price" value="<?= $row['price'] ?>">
                                    <input type="hidden" name="sale_price" value="<?= $row['sale_price'] ?>">
                                    <input type="hidden" name="content" value="<?= $row['content'] ?>">
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- // Bình luận sản phẩm -->

                    <form action="" method="POST">
                        <div class="mb-3">
                            <h2><label for="exampleFormControlInput1" class="form-label">Bình luận</label></h2>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="comment"
                                name="comment">
                            <?php if (isset($canhbao)) {
                                echo $canhbao;
                            }
                            ?>
                            <br />
                            <button class="btn btn-primary" type="Gui">Gửi</button>
                        </div>
                </div>
                </form>
                <!-- Kéo dữ liệu từ database về -->
                <h4>
                    <li class="list-group-item active" aria-current="true">Nội Dung Bình Luận</li>
                </h4>
                <?php if (isset($comment)): ?>
                    <?php foreach ($comment as $data): ?>
                        <form action="#" method="POST">
                            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
                                <div class="offcanvas-header">
                                </div>
                                <div class="offcanvas-body">
                                    <!-- KÉO DỮ LIỆU CỦA NÓ QUĂNG VÔ ĐÂY -->
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <h5>
                                                <?= $data['username'] ?>
                                            </h5>
                                            <?= $data['content'] ?>
                                            <p>Ngày đăng:
                                                <?= $data['ngay'] ?>
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </div>
        <div class="container">
            <br>
            <div class="row">
                <?php foreach ($sanphamtuongtu as $product): ?>
                    <div class="col-lg-3 col-md-2 all des">
                        <form action="" method="post">
                            <div class="product-item">
                                <a href="?id=<?= $product['id'] ?>"> <img src="../admin/<?= $product['thumbnail'] ?>" alt=""
                                        width="200px" height="360px"></a>
                                <div class="down-content">
                                    <a href="#">
                                        <h4>
                                            <?= $product['name'] ?>
                                        </h4>
                                    </a>
                                    <h4><del><b>Giá:
                                                <?= number_format($product['price'], 0, ", ", ".") ?>đ
                                            </b></del></h4>

                                    <h4>Giá Giảm:
                                        <?= number_format($product['sale_price'], 0, ", ", ".") ?>đ
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
                                    <p>Lượt xem:
                                        <?= $product['view'] ?>
                                    </p>

                                </div>
                            </div>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
        include_once "components/footer.php";
        ?>
    <?php }
mysqli_close($conet); ?>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



    <script src="../assets/js/custom.js"></script>
    <script src="../assets/js/owl.js"></script>
    <script src="../assets/js/slick.js"></script>
    <script src="../assets/js/isotope.js"></script>
    <script src="../assets/js/accordions.js"></script>


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