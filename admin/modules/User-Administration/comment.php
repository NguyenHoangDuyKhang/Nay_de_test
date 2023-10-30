<?php
include_once 'connet/connet.php';
include_once "function/function.php";
$sql = "SELECT * FROM comment";
$retval = $conet->query($sql);
// Này xóa bằng id
if (isset($_GET["id"])) {
  $id = $_GET['id'];
  $sql_db = "DELETE FROM comment WHERE id_cm ='$id'";
  if (mysqli_query($conet, $sql_db)) {
    echo "<script>
    alert('Bình luận đã được xóa thành công') ;
    </script>";
  } else {
    echo "Error" . $sql_db . "<br>" . mysqli_error($conet);
  }
} 
$count = GetCount($conet,'comment');
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
$thongtin = GetDataPage($conet,'comment',$startFrom,$recordsPerPage);
?>



<script src="https://kit.fontawesome.com/55f801a73d.js" crossorigin="anonymous"></script>
<div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>User Name</th>
                      <th>Content</th>
                      <th>Ngày Đăng</th>
                      <th>Xóa Thông Tin Người Dùng</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach($thongtin as $data_cm): ?>
                    <tr>
                      <td> <?= $data_cm['id_cm'] ?> </td>
                      <td> <?= $data_cm['name'] ?> </td>
                      <td><?= $data_cm['content'] ?></td>
                      <td><?= $data_cm['ngaydang'] ?></td>
          <td> <a href="?action=comment&id=<?=$data_cm['id_cm'] ?>" <button type="button"
              class="btn btn-outline-danger" width="200"><i class="fa-solid fa-rectangle-xmark fa-beat"></i> Xóa Bình Luận</button></a> </td>
                 
            </tr>
                   
                  <?php endforeach ?>
                  
  </tbody>
                </table>
              </div>
            </div>

            <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <?php if($current_page > 1): ?>    
                                <li class="page-item">
                                    <a class="page-link" href="?action=comment" tabindex="-1" aria-disabled="true">Star page</a>
                                </li>
                                <?php endif; ?>
                                <?php if($current_page >= 1): ?>
                                    <?php $next =  $current_page - 1 ?> 
                                <li class="page-item">
                                    <a class="page-link" href="?action=comment&page-item=<?= $next ?>">Back</a>
                                </li>
                                <?php endif; ?>
                                
                                 <?php for($i = max(1, $current_page - 2); $i <= min($current_page + 2, $totalPages); $i++): ?>
                                 <?php if($i == $current_page):?>
                                <li class="page-item">
                                <strong> <a class="page-link" href="#"><?= $i ?></a></strong>
                                </li>
                                <?php else: ?>
                                <li class="page-item">
                                    <a class="page-link" href="?action=comment&page-item=<?= $i ?>"><?= $i ?></a>
                                </li>
                                <?php endif ?>
                                <?php endfor; ?>

                                <?php if($current_page >= 1): ?>
                                    <?php $next =  $current_page +1 ?> 
                                <li class="page-item">
                                    <a class="page-link" href="?action=comment&page-item=<?= $next ?>">Next</a>
                                </li>
                                <?php endif; ?>
                                <?php if($current_page < $totalPages): ?>    
                                <li class="page-item">
                                    <a class="page-link" href="?action=comment&page-item=<?= $totalPages ?>" tabindex="-1" aria-disabled="true">End page</a>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                        <?php  mysqli_close($conet) ?>