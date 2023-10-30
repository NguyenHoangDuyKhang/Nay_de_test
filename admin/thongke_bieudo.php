<?php
include "connet/connet.php"; 
$query = "SELECT product_categories.name as tendm ,COUNT(products.category_id) as sl, MAX(products.sale_price) as maxgia, MIN(products.sale_price) as mingia 
FROM products JOIN product_categories ON products.category_id = product_categories.id GROUP BY product_categories.name";
$result = mysqli_query($conet, $query);
$thongke = mysqli_fetch_all($result, MYSQLI_ASSOC);
 if (!$result) {
     die("Lỗi truy vấn: " . mysqli_error($conet));
 } 
?>
<html>
  <head>
  <script src="https://kit.fontawesome.com/55f801a73d.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['tendm', 'sl'],
            <?php
                foreach($thongke as $inra){
                    echo "['" .$inra['tendm'] . "', " .$inra['sl'] . "],";
                }
                ?>
         
        ]);
        var options = {
          title: 'THỐNG KÊ SỐ LƯỢNG SẢN PHẨM THEO DANH MỤC',
          pieHole: 0.5,
        };
        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="donutchart" style="width: 100%; height: 600px;"></div>
  </body>
  <td><a href="http://asm/admin/?action=statistical_tb"><button type="button" class="btn btn-outline-primary"> <i class="fa-solid fa-pen-to-square fa-shake"></i>
              Xem Bảng</button></a></td>
</html>