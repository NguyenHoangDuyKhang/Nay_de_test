<?php
include_once 'connet/connet.php';
include_once "function/function.php";
$id = "";
// Này xóa bằng ID
if (isset($_GET["id"])) {
  $id = $_GET['id'];
  $sql_db = "DELETE FROM orders WHERE id ='$id'";
  $sql = "DELETE FROM order_detail WHERE order_id = '$id'";
  if (mysqli_query($conet, $sql_db)){
    echo "Xóa Thành Công";
  } else {
    echo "Error" . $sql_db . "<br>" . mysqli_error($conet);
  }
  if (mysqli_query($conet, $sql)){
    echo "Xóa Thành Công";
  } else {
    echo "Error" . $sql . "<br>" . mysqli_error($conet);
  }
} 
$count = GetCount($conet,'orders');
// Số lượng bản ghi hiển thị trên mỗi trang
$totalRecords = $count;
$recordsPerPage = 6;

// Trang hiện tại (nếu không được xác định, mặc định là trang 1)
$current_page = isset($_GET['page-item']) ? $_GET['page-item'] : 1;

// Tính số lượng trang cần hiển thị
$totalPages = ceil($totalRecords / $recordsPerPage);

// Giới hạn giá trị trang hiện tại trong khoảng từ 1 đến tổng số trang
$current_page = max(1, min($current_page, $totalPages));

// Tính vị trí bắt đầu lấy dữ liệu từ CSDL
$startFrom = ($current_page - 1) * $recordsPerPage;
$thongtin = GetDataPage($conet,'orders',$startFrom,$recordsPerPage);


?>



<script src="https://kit.fontawesome.com/55f801a73d.js" crossorigin="anonymous"></script>

<div class="card-body table-responsive p-0" style="height: 500px;">
                <table class="table table-head-fixed text-nowrap">
               
                  <thead>
                    <tr>
                      <th>Tên Khách Hàng</th>
                      <th>SĐT</th>
                      <th>Email</th>
                      <th>Địa Chỉ</th>
                     
                      
                      <th>Thao Tác</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach($thongtin as $user): ?>
                    <tr>
                      <td> <?= $user['customer_name'] ?> </td>
                      <td><?= $user['customer_phone'] ?></td>
                      <td><?= $user['customer_email'] ?></td>
                      <td><?=$user['address_nguoimua']?></td>
                    
                  
          <td> <a href="?action=order_detail&id=<?=$user['id'] ?>" <button type="button"
              class="btn btn-outline-danger" width="200" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-rectangle-xmark fa-beat"></i></i> Xóa Thông Tin Đơn Hàng</button></a> 
            </td>
              
              <td><a href="?action=order&id=<?=$user['id']?>"><button type="button" class="btn btn-outline-primary"> <i class="fa-solid fa-pen-to-square fa-shake"></i>
             Xem chi tiết đơn hàng</button></a></td>
                    </tr>
                  </tbody>
                  <?php endforeach ?>
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">BẠN CÓ CHẮC MUỐN XÓA ĐƠN HÀNG NÀY KHÔNG?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"  class="btn btn-outline-danger"><i class="fa-solid fa-rectangle-xmark fa-beat" ></i></button>
      </div>
      <div class="modal-body">
       Đơn Hàng sau khi bị xóa không thể khôi phục!!!
      </div>
      <div class="modal-footer"> 
        <a href="?action=order_detail&id=<?=$user['id'] ?>"><button type="button"  class="btn btn-outline-danger">Xóa</button></a>
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
                                    <a class="page-link" href="?action=order_detail" tabindex="-1" aria-disabled="true">Star page</a>
                                </li>
                                <?php endif; ?>
                                <?php if($current_page >= 1): ?>
                                    <?php $next =  $current_page - 1 ?> 
                                <li class="page-item">
                                    <a class="page-link" href="?action=order_detail&page-item=<?= $next ?>">Back</a>
                                </li>
                                <?php endif; ?>
                                
                                 <?php for($i = max(1, $current_page - 2); $i <= min($current_page + 2, $totalPages); $i++): ?>
                                 <?php if($i == $current_page):?>
                                <li class="page-item">
                                <strong> <a class="page-link" href="#"><?= $i ?></a></strong>
                                </li>
                                <?php else: ?>
                                <li class="page-item">
                                    <a class="page-link" href="?action=order_detail&page-item=<?= $i ?>"><?= $i ?></a>
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