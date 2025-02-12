<?php 
//ไฟล์เชื่อมต่อฐานข้อมูล
require_once 'config/condb.php';
$stmt = $condb->prepare("
SELECT d.deliveryDate, d.order_customerName_ref, 
d.order_receiverName, d.order_receiverPhone, d.order_payment,
d.order_pickupLocation, d.description
FROM tb_customer as c
INNER JOIN tb_delivery as d ON d.order_customerName_ref = c.customerName
ORDER BY c.id
");

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// echo '<pre>';
// print_r($result);
// echo '</pre>';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <div class="container mt-5">
        <div class="row">
            <div class="colsm-12">
            <table class="table table-striped  table-hover table-bordered table-sm">
              <thead class="table-success text-center">
                <tr>
                    <th>ว/ด/ป</th>
                    <th>ชื่อคนสั่ง</th>
                    <th>ชื่อคนรับ</th>
                    <th>เบอร์คนรับ</th>
                    <th>การชำระเงิน</th>
                    <th>สถานที่นัดรับ</th>
                    <th>รายละเอียด</th>
                    <th colspan="2">จัดการ</th>
                </tr>
              </thead>
              <tbody>
                <!-- foreach ดึงข้อมูลแต่ละแถวมาแสดงผล โดยกำหนด $row เป็นแถวแต่ละแถว -->
                    <?php foreach ($result as $row) { ?>
                        <tr>
                            <!-- $row['ชื่อของคอลลัมภ์ในฐานข้อมูล ที่จะดึงข้อมูลมาแสดง'] -->
                             <td><?=$row['deliveryDate'];?></td>
                             <td><?=$row['order_customerName_ref'];?></td>
                             <td><?=$row['order_receiverName'];?></td>
                             <td><?=$row['order_receiverPhone'];?></td>
                             <td><?=$row['order_payment'];?></td>
                             <td><?=$row['order_pickupLocation'];?></td>
                             <td><?=$row['description'];?></td>
                             <td class="text-center"><a href="#" class="btn btn-warning btn-sm">แก้ไข</a></td>
                             <td class="text-center"><a href="#" class="btn btn-danger btn-sm">ลบ</a></td>
                        </tr>
                    <?php } ?>
              </tbody>
            </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>