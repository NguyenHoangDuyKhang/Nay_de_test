<?php
// KẾT NỐI DATA BASE
include_once 'connet/connet.php';
include_once "function/function.php";
// NÀY LÀM CHỨC NĂNG XÓA KHI CHECK
if(isset($_POST['xoaall'])){
  if (isset($_POST['checkbox'])){
  $arr = $_POST['checkbox'];
  $del = implode(",",$arr);
  $sql_db = "DELETE FROM discount WHERE id IN ($del)";
  if (mysqli_query($conet, $sql_db)) {
    echo "<script>
    alert('XÓA THÀNH CÔNG') ;
    </script>";
  } else {
    echo "Error" . $sql_db . "<br>" . mysqli_error($conet);
  }
} 
}

$sql = "SELECT * FROM discount";
$retval = $conet->query($sql);

if (isset($_GET["id"])) {
  $id = $_GET['id'];
  $sql_db = "DELETE FROM discount WHERE id = $id";
  if (mysqli_query($conet, $sql_db)) {
    
  } else {
    echo "Error" . $sql_db . "<br>" . mysqli_error($conet);
  }
}
$count = GetCount($conet,'discount');
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

if(isset($_GET['categori']) && $_GET['categori'] > 0 ){
  $id  = $_GET['categori'];
  $data = GetProductByCategori($id);
}else{
  $data = GetDataPage($conet,'discount',$startFrom,$recordsPerPage);
}
?>
<script src="https://kit.fontawesome.com/55f801a73d.js" crossorigin="anonymous"></script>
<div class="row">            
        <div class="col-12">
            <div class="card">          
                <!-- Danh mục sản phẩm -->
                
<div class="card-body table-responsive p-0" style="height: 350px;">
<form action="" method="POST" enctype="multipart/form-data">
  <table class="table table-head-fixed text-nowrap">
    <thead>
      <tr>
        <th></th>
        <th>Mã Giảm Giá</th>
        <th>Số Lượng</th>
        <th>Giá Trị</th>
        <th>Ngày Hết Hạn</th>
        <th>Sửa Mã</th>
        <th>Xóa Mã</th>
      </tr>
    </thead>
    
    <tbody>
        <!-- SÀI WHILE ĐỂ IN CÁC DỮ LIỆU RA -->
        <?php if (isset($data)): ?>
      <?php foreach($data as $print): ?>
        <tr>
          <td>
            <input type="checkbox" name='checkbox[]' value='<?=$print['id'] ?>'>
          </td>
          <td>
            <?= $print['code'] ?>
          </td>
          <td>
            <?=$print['quantity']?>
          </td>
          <td>
           <?=$print['discount_type']?>
          </td>
          <td> <?= $print['expiration_date']?></td>
          <td><a href="?action=edit_discount&id=<?=$print['id'] ?>"><button type="button" class="btn btn-outline-primary"> <i class="fa-solid fa-pen-to-square fa-shake"></i>
              Sửa Mã</button></a></td>
          <td> <a href="?action=danhsach_discount&id=<?=$print['id'] ?>"><button type="button"
              class="btn btn-outline-danger" width="200" data-bs-toggle="modal" data-bs-target="#Modal<?=$print['id'] ?>"><i class="fa-solid fa-rectangle-xmark fa-beat"></i></i> Xóa Mã
              </button></a> </td>
              <td>
              </td>
        </tr>
        <?php endforeach; ?>
  <?php endif?>
      

    </tbody>
   
  </table>
  
 
        <label for="checkAll">Check All <i class="fa-solid fa-arrow-right fa-bounce"></i></label>
        <input type="checkbox" id="checkAll" onclick="checkAllCheckboxes()">
        </br>
       
        <button type="submit" name="xoaall"
              class="btn btn-outline-danger" width="200"><i class="fa-solid fa-rectangle-xmark fa-beat"></i></i> Xóa mã giảm giá đã chọn</button>
              </form>  
</div>
<script>
        function checkAllCheckboxes() {
            var checkboxes = document.getElementsByName('checkbox[]');
            var checkAllCheckbox = document.getElementById('checkAll');

            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = checkAllCheckbox.checked;
            }
        }
</script>

<nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <?php if($current_page > 1): ?>    
                                <li class="page-item">
                                    <a class="page-link" href="?action=oder&add=danhsachsanpham" tabindex="-1" aria-disabled="true">Star page</a>
                                </li>
                                <?php endif; ?>
                                <?php if($current_page >= 1): ?>
                                    <?php $next =  $current_page - 1 ?> 
                                <li class="page-item">
                                    <a class="page-link" href="?action=oder&add=danhsachsanpham&page-item=<?= $next ?>">Back</a>
                                </li>
                                <?php endif; ?>
                                
                                 <?php for($i = max(1, $current_page - 2); $i <= min($current_page + 2, $totalPages); $i++): ?>
                                 <?php if($i == $current_page):?>
                                <li class="page-item">
                                <strong> <a class="page-link" href="#"><?= $i ?></a></strong>
                                </li>
                                <?php else: ?>
                                <li class="page-item">
                                    <a class="page-link" href="?action=oder&add=danhsachsanpham&page-item=<?= $i ?>"><?= $i ?></a>
                                </li>
                                <?php endif ?>
                                <?php endfor; ?>

                                <?php if($current_page >= 1): ?>
                                    <?php $next =  $current_page +1 ?> 
                                <li class="page-item">
                                    <a class="page-link" href="?action=oder&add=danhsachsanpham&page-item=<?= $next ?>">Next</a>
                                </li>
                                <?php endif; ?>
                                <?php if($current_page < $totalPages): ?>    
                                <li class="page-item">
                                    <a class="page-link" href="?action=oder&add=danhsachsanpham&page-item=<?= $totalPages ?>" tabindex="-1" aria-disabled="true">End page</a>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                        <?php  mysqli_close($conet) ?>