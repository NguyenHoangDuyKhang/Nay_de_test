      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="index.php"><h2>K-<em>Phones</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="../index.php">TRANG CHỦ
                  <span class="sr-only">(current)</span>
                </a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" href="../products.php">SẢN PHẨM</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../news.php">TIN TỨC</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../card.php">GIỎ HÀNG</a>
              </li>
              <?php
              $Signin = 'ĐĂNG NHẬP';
              $account = 'TÀI KHOẢNG';
              $hienthi = "";
              if(isset($_SESSION['email']) && isset($_SESSION['name'])){
                $hienthi = $account; 
             ?>
              <li class="nav-item">
                <a class="nav-link" href="../account.php"><?=$hienthi?></a>
              </li>
              <?php
                  } else{
                    $hienthi =  $Signin; 
              ?>
              <li class="nav-item">
                <a class="nav-link" href="../dangnhap.php"><?=$hienthi?></a>
              </li>
              <?php
              }
              ?>
            </ul>
          </div>
        </div>
      </nav>
  