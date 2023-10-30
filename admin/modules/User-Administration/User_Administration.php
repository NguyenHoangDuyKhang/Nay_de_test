<?php
include_once 'connet/connet.php';
include_once "function/function.php";
$sql = "SELECT id, name, email, password FROM users";
$retval = $conet->query($sql);

// Này xóa bằng Email
if (isset($_GET["email"])) {
  $email = $_GET['email'];
  $sql_db = "DELETE FROM users WHERE email ='$email'";
  if (mysqli_query($conet, $sql_db)) {
    echo "Xóa thành công";
  } else {
    echo "Error" . $sql_db . "<br>" . mysqli_error($conet);
  }
} 
$count = GetCount($conet,'users');

// Số lượng bản ghi hiển thị trên mỗi trang
$totalRecords = $count;
$recordsPerPage = 3;

// Trang hiện tại (nếu không được xác định, mặc định là trang 1)
$current_page = isset($_GET['page-item']) ? $_GET['page-item'] : 1;

// Tính số lượng trang cần hiển thị
$totalPages = ceil($totalRecords / $recordsPerPage);

// Giới hạn giá trị trang hiện tại trong khoảng từ 1 đến tổng số trang
$current_page = max(1, min($current_page, $totalPages));

// Tính vị trí bắt đầu lấy dữ liệu từ CSDL
$startFrom = ($current_page - 1) * $recordsPerPage;
$thongtin = GetDataPage($conet,'users',$startFrom,$recordsPerPage);
?>



<script src="https://kit.fontawesome.com/55f801a73d.js" crossorigin="anonymous"></script>
<div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>User Name</th>
                      <th>Email</th>
                      <th>Password</th>
                      <th>Xóa Thông Tin Người Dùng</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach($thongtin as $users): ?>
                    <tr>
                      <td> <?= $users['id'] ?> </td>
                      <td> <?= $users['name'] ?> </td>
                      <td><?= $users['email'] ?></td>
                      <td><?= $users['password'] ?></td>
          <td> <a href="?action=user&email=<?=$users['email']?>" <button type="button"
              class="btn btn-outline-danger" width="200" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-rectangle-xmark fa-beat"></i></i> Xóa Thông Tin Người Dùng</button></a> </td>
                    </tr>
                  </tbody>
                  <?php endforeach ?>
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">BẠN CÓ CHẮC MUỐN XÓA TÀI KHOẢNG NÀY KHÔNG?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"  class="btn btn-outline-danger"><i class="fa-solid fa-rectangle-xmark fa-beat" ></i></button>
      </div>
      <div class="modal-body">
       Tài Khoảng sau khi bị xóa không thể khôi phục!!!
      </div>
      <div class="modal-footer"> 
        <a href="?action=user&email=<?=$users['email']?>"><button type="button"  class="btn btn-outline-danger">Xóa</button></a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
                </table>
              </div>
            </div>

            <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <?php if($current_page > 1): ?>    
                                <li class="page-item">
                                    <a class="page-link" href="?action=user" tabindex="-1" aria-disabled="true">Star page</a>
                                </li>
                                <?php endif; ?>
                                <?php if($current_page >= 1): ?>
                                    <?php $next =  $current_page - 1 ?> 
                                <li class="page-item">
                                    <a class="page-link" href="?action=user&page-item=<?= $next ?>">Back</a>
                                </li>
                                <?php endif; ?>
                                
                                 <?php for($i = max(1, $current_page - 2); $i <= min($current_page + 2, $totalPages); $i++): ?>
                                 <?php if($i == $current_page):?>
                                <li class="page-item">
                                <strong> <a class="page-link" href="#"><?= $i ?></a></strong>
                                </li>
                                <?php else: ?>
                                <li class="page-item">
                                    <a class="page-link" href="?action=user&page-item=<?= $i ?>"><?= $i ?></a>
                                </li>
                                <?php endif ?>
                                <?php endfor; ?>

                                <?php if($current_page >= 1): ?>
                                    <?php $next =  $current_page +1 ?> 
                                <li class="page-item">
                                    <a class="page-link" href="?action=user&page-item=<?= $next ?>">Next</a>
                                </li>
                                <?php endif; ?>
                                <?php if($current_page < $totalPages): ?>    
                                <li class="page-item">
                                    <a class="page-link" href="?action=user&page-item=<?= $totalPages ?>" tabindex="-1" aria-disabled="true">End page</a>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                        <?php  mysqli_close($conet) ?>