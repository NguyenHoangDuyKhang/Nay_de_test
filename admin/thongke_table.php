<?php
include "connet/connet.php";
$query = "SELECT product_categories.name as tendm ,COUNT(products.category_id) as sl, MAX(products.sale_price) as maxgia, MIN(products.sale_price) as mingia ,  AVG(products.sale_price) as tb 
FROM products JOIN product_categories ON products.category_id = product_categories.id GROUP BY product_categories.name";
$result = mysqli_query($conet, $query);
$thongke = mysqli_fetch_all($result, MYSQLI_ASSOC);
if (!$result) {
    die("Lỗi truy vấn: " . mysqli_error($conet));
}
?>
<script src="https://kit.fontawesome.com/55f801a73d.js" crossorigin="anonymous"></script>
<div class="card-body table-responsive p-0" style="height: 450px;">
    <table class="table table-head-fixed text-nowrap">
        <thead><div class="card-header"><h1 style="color: red;">Thống Kê</h1></div>
            <tr>
                <th>Tên Danh Mục</th>
                <th>Số Lượng Sản Phẩm</th>
                <th>Giá Lớn Nhất</th>
                <th>Giá Nhỏ Nhất</th>
                <th>Giá Trung Bình</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($thongke as $in): ?>
                <tr>
                    <td>
                        <?= $in['tendm'] ?>
                    </td>
                    <td>
                        <?= $in['sl'] ?>
                    </td>
                    <td>
                        <?= number_format($in['maxgia'], 0, ",",".")?>đ
                    </td>
                    <td>
                        <?= number_format($in['mingia'], 0, ",",".") ?>đ
                    </td>
                    <td>
                        <?=number_format($in['tb'], 0, ",",".")?>đ
                    </td>
                <?php endforeach ?>
               
        </tbody>
        <td><a href="http://asm/admin/?action=statistical"><button type="button" class="btn btn-outline-primary"> <i class="fa-solid fa-pen-to-square fa-shake"></i>
              Xem Biểu Đồ</button></a></td>
    </table>
</div>
</div>