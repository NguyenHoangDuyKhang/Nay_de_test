<?php
include_once 'connet/connet.php';
include_once "function/function.php";
$name = "";
$content = "";
$slug = "";
$thumbnail ="";
$category_id = "";
$created_at = "";

$sql = "SELECT id , name, content ,slug, thumbnail, category_id, created_at FROM posts";
$retval = $conet->query($sql);

if (isset($_GET["id"])) {
  $id = $_GET['id'];
  $sql_db = "DELETE FROM posts WHERE id ='$id'";
  if (mysqli_query($conet, $sql_db)) {
    echo "Xóa Thành Công";
  } else {
    echo "Error" . $sql_db . "<br>" . mysqli_error($conet);
  }
} 
$count = GetCount($conet,'posts');


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
$bientam = GetDataPage($conet,'posts',$startFrom,$recordsPerPage);
?>



<script src="https://kit.fontawesome.com/55f801a73d.js" crossorigin="anonymous"></script>
<div class="card-body table-responsive p-0" style="height: 450px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Mã Bài Viết</th>
                      <th>Tên Bài Viết</th>
                      <th>Nội Dung</th>
                      <th>Slug</th>
                     
                      <th>Ảnh Bài Viết</th>
                      <th>Danh Mục Bài Viết</th>
                      <th>Sửa Bài Viết</th>
                      <th>Xóa Bài Viết</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach($bientam as $in): ?>
                    <tr>
                      <td> <?= $in['id'] ?> </td>
                      <td> <?= $in['name'] ?> </td>
                      <td><?= $in['content'] ?></td>
                      <td><?= $in['slug'] ?></td>
                    
                      <td>
                      <img src="<?= $in['thumbnail'] ?>" alt="" width="150px" >  </td>

                      <td><? if($in['category_id'] == 1){
                        echo "Iphone";
                      } else if ($in['category_id'] == 2){
                        echo "Samsung";
                      }
                        ?></td>
                      <td><a href="?action=post&add=edit-baiviet&id=<?=$in['id'] ?>"><button type="button" class="btn btn-outline-primary"> <i class="fa-solid fa-pen-to-square fa-shake"></i>
              Sửa Bài Viết</button></a></td>
          <td> <a href="?action=post&add=danhsachbaiviet&id=<?=$in['id'] ?>" <button type="button"
              class="btn btn-outline-danger" width="200" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-rectangle-xmark fa-beat"></i></i> Xóa Bài Viết</button></a> </td>
                    </tr>
                  <?php endforeach ?>
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">BẠN CÓ CHẮC MUỐN XÓA BÀI VIẾT NÀY KHÔNG?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"  class="btn btn-outline-danger"><i class="fa-solid fa-rectangle-xmark fa-beat" ></i></button>
      </div>
      <div class="modal-body">
        Bài Viết sau khi bị xóa không thể khôi phục!!!
      </div>
      <div class="modal-footer"> 
        <a href="?action=post&add=danhsachbaiviet&id=<?=$in['id'] ?>"><button type="button"  class="btn btn-outline-danger">Xóa</button></a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</tbody>
                </table>
              </div>
            </div>

            <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <?php if($current_page > 1): ?>    
                                <li class="page-item">
                                    <a class="page-link" href="?action=post&add=danhsachbaiviet" tabindex="-1" aria-disabled="true">Star page</a>
                                </li>
                                <?php endif; ?>
                                <?php if($current_page >= 1): ?>
                                    <?php $next =  $current_page - 1 ?> 
                                <li class="page-item">
                                    <a class="page-link" href="?action=post&add=danhsachbaiviet&page-item=<?= $next ?>">Back</a>
                                </li>
                                <?php endif; ?>
                                
                                 <?php for($i = max(1, $current_page - 2); $i <= min($current_page + 2, $totalPages); $i++): ?>
                                 <?php if($i == $current_page):?>
                                <li class="page-item">
                                <strong> <a class="page-link" href="#"><?= $i ?></a></strong>
                                </li>
                                <?php else: ?>
                                <li class="page-item">
                                    <a class="page-link" href="?action=post&add=danhsachbaiviet&page-item=<?= $i ?>"><?= $i ?></a>
                                </li>
                                <?php endif ?>
                                <?php endfor; ?>

                                <?php if($current_page >= 1): ?>
                                    <?php $next =  $current_page +1 ?> 
                                <li class="page-item">
                                    <a class="page-link" href="?action=post&add=danhsachbaiviet&page-item=<?= $next ?>">Next</a>
                                </li>
                                <?php endif; ?>
                                <?php if($current_page < $totalPages): ?>    
                                <li class="page-item">
                                    <a class="page-link" href="?action=post&add=danhsachbaiviet&page-item=<?= $totalPages ?>" tabindex="-1" aria-disabled="true">End page</a>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                        <?php  mysqli_close($conet) ?>