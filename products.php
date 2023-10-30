<?php
session_start();
include_once 'admin/function/function.php';
include_once 'admin/connet/connet.php';
$data = GetAllpro();
//LẤY 1O SẢN PHẨM CÓ LƯỢT XEM NHIỀU NHẤT
$view = Get_top10_view();
//TIỀM KIẾM THEO TÊN
if (isset($_POST['submit_timten'])){
  $timkiem = $_POST['timkiem'];
  if ($timkiem != "" && $timkiem != NULL) {
    $data = timkiem($conet, $timkiem);
  } else if ($timkiem == ""){
    $sql = "SELECT * FROM products";
    $result = mysqli_query($conet, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $thongbao = "VUI LÒNG NHẬP TÊN SẢN PHẨM ĐỂ TÌM KIẾM";
  }
}
 if ($data== NULL){
      $thongbao_timkiem = "SẢN PHẨM TÌM KIẾM KHÔNG TỒN TẠI";
    }
// Tìm Theo danh mục
$danhmuc = Get_product_categories();
if (isset($_POST['submit_danhmuc'])) {
  $tendanhmuc = $_POST['danhmuc'];
 $data = loctheodanhmuc($tendanhmuc);
}

if (isset($_POST['submit_loc'])){
$kieu = $_POST['loc'];
if($kieu == 1){
  $data = Get_Max_price();
} else if($kieu == 2){
  $data = Get_Min_price();
} else if ($kieu == 3){
  $data = Get_data_new();
} else if($kieu == 4){
  $data = Get_data_old();
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
  <title>Wolves Phones - Products</title>

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
      <form class=" col-6 col-sm-3" action="" method="post">
        <input class="stext" type="text" name="timkiem" placeholder="Tìm kiếm...">
        <button type="submit" name="submit_timten" class='ms-2 p-1 rounded-1 border-0 bnt btn-primary '>
          <i class="fa fa-search"></i></button>
        <br>
        <?php
        if (isset($thongbao)) {
          echo $thongbao;
        }
        ?>
      </form>
      <!-- Này là Cái danh mục ok chưa? -->
      <form class="danhmucsanpham  col-sm-3" action="" method="post">
      <select class="form-select" aria-label="Default select example" name="danhmuc">
          <?php
          foreach ($danhmuc as $frint): ?>
            <option <?= (isset($_POST["categori"]) && $_POST["categori"] === $frint['id']) ?> value="<?= $frint['name']?>">
              <?= $frint['name'] ?>
            </option>
          <?php endforeach ?>
        </select>
        <button type="submit" name="submit_danhmuc" class='ms-2 p-1 rounded-2 border-0 bnt btn-primary '>
          <i class="fa fa-search"></i></button>
        <br>
      </form>

      <!-- Này là lọc theo giá -->
      <form class="loctheogia" action="" method="post">
      <select class="form-select" aria-label="Default select example" name="loc">
            <option value="0">
             Lọc Theo
            </option>

            <option value="1">
             Giá Từ Cao Đến Thấp
            </option>
        
            <option value="2">
             Giá Từ Thấp Đến Cao
            </option>
         

            <option  value="3">
            Sản Phẩm Mới Nhất
            </option>

            <option  value="4">
            Sản Phẩm Cũ Nhất
            </option>
        </select>
        <button type="submit" name="submit_loc" class='ms-2 p-1 rounded-2 border-0 bnt btn-primary '>
          <i class="fa fa-search"></i></button>
        <br>
      </form>
      </div>
      <br/>
      <div class="row">
        <? if (isset($thongbao_timkiem)) {
          echo $thongbao_timkiem;
        } ?>
        <?php if (isset($data)): ?>
          <?php foreach ($data as $product): ?>
            <div class="col-lg-3 col-md-3 all des">
              <form action="card.php" method="post">
                <div class="product-item">
                  <a href="chitiet.php/?id=<?=$product['id'] ?>"> <img src="admin/<?= $product['thumbnail'] ?>" alt=""
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
                    <p>Ngày Bán
                      <?= $product['created_at'] ?>
                    </p>
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center pb-2 mb-1">
                        <button type="submit" class="btn btn-primary" name="addcart">Thêm vào giỏ hàng</button>
                        <input type="hidden" name="id" value="<?= $product['id'] ?>">
                        <input type="hidden" name="thumbnail" value="<?= $product['thumbnail'] ?>">
                        <input type="hidden" name="name" value="<?= $product['name'] ?>">
                        <input type="hidden" name="price" value="<?= $product['price'] ?>">
                        <input type="hidden" name="sale_price" value="<?= $product['sale_price'] ?>">
                        <input type="hidden" name="content" value="<?= $product['content'] ?>">
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>

      <form action="#" method="post">
        <ul class="list-group">
          <li class="list-group-item active">Sản Phẩm được xem nhiều nhất</li>
          <?php if (isset($view)): ?>
            <?php foreach ($view as $data_PRO): ?>
              <li class="list-group-item"><a href="chitiet.php?id=<?=$data_PRO['id'] ?>"><img
                    src="admin/<?= $data_PRO['thumbnail'] ?>" alt="" width="50px" height="80px"></a> <a
                  href="chitiet.php?id=<?= $data_PRO['id'] ?>">
                  <?= $data_PRO['name'] ?>
                </a> </li>
            <?php endforeach ?>
          <?php endif ?>
        </ul>

      </form>

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
<?php mysqli_close($conet) ?>