<?php
//ไฟล์เชื่อมต่อฐานข้อมูล
require_once 'config/condb.php';
// $stmt = $condb->prepare("
// SELECT d.deliveryDate, d.order_customerName_ref, 
// d.order_receiverName, d.order_receiverPhone, d.order_payment,
// d.order_pickupLocation, d.description
// FROM tb_customer as c
// INNER JOIN tb_delivery as d ON d.order_customerName_ref = c.customerName
// ORDER BY c.id
// ");

$stmt = $condb->prepare("
SELECT deliveryDate, order_customerName_ref, 
order_receiverName, order_receiverPhone, order_payment,
order_pickupLocation, description
FROM tb_delivery        
");

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// echo '<pre>';
// print_r($result);
// echo '</pre>';


if(isset($_POST['order_customerName_ref']) && isset($_POST['action']) && $_POST['action'] == 'edit'){

    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
    // exit();

    try {

        //ประกาศตัวแปรรับค่าจากฟอร์ม
        $deliveryDate = $_POST['deliveryDate'];
        $order_customerName_ref = $_POST['order_customerName_ref'];
        $order_receiverName = $_POST['order_receiverName'];
        $order_receiverPhone = $_POST['order_receiverPhone'];
        $order_payment = $_POST['order_payment'];
        $order_pickupLocation = $_POST['order_pickupLocation'];
        $description = $_POST['description'];

        //SQL INSERT
        $stmtInsert = $condb->prepare('INSERT tb_delivery
        (deliveryDate, order_customerName_ref, order_receiverName,
        order_receiverPhone, order_payment, order_pickupLocation,
        description
        )
        
        VALUES
        
        (:deliveryDate, :order_customerName_ref, :order_receiverName,
        :order_receiverPhone, :order_payment, :order_pickupLocation,
        :description
        )
        ');

        //bindparam STR // INT
        $stmtInsert->bindparam(':deliveryDate', $deliveryDate, PDO::PARAM_STR);
        $stmtInsert->bindparam(':order_customerName_ref', $order_customerName_ref, PDO::PARAM_STR);
        $stmtInsert->bindparam(':order_receiverName', $order_receiverName, PDO::PARAM_STR);
        $stmtInsert->bindparam(':order_receiverPhone', $order_receiverPhone, PDO::PARAM_STR);
        $stmtInsert->bindparam(':order_payment', $order_payment, PDO::PARAM_STR);
        $stmtInsert->bindparam(':order_pickupLocation', $order_pickupLocation, PDO::PARAM_STR);
        $stmtInsert->bindparam(':description', $description, PDO::PARAM_STR);

        if ($stmtInsert->execute()) {
            echo '<script>
                        setTimeout(function() {
                        swal({
                            title: "เพิ่มข้อมูลสำเร็จ",
                            type: "success"
                            }, function() {
                                window.history.replaceState(null, "", window.location.href); //หน้าที่ต้องการให้กระโดดไป
                                window.location.reload();
                            });
                        }, 1000);
                    </script>';
        }

    } catch (Exception $e) {
        echo 'Message: '.$e->getMessage();
        exit;
        echo '<script>
                    setTimeout(function() {
                    swal({
                        title: "เกิดข้อผิดพลาด",
                        text: "กรุณาติดต่อผู้ดูแลระบบ",
                        type: "error"
                    }, function() {
                        window.history.replaceState(null, "", window.location.href);
                        window.location.reload();
                    });
                    }, 1000);
                </script>';
    } //catch
} //isset

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- sweet alert -->
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="colsm-12">
                <h2>จัดการข้อมูลส่งของย้อนหลัง</h2>
                <!-- <a href="customer_add.php" class="btn btn-info mb-3">เพิ่มลูกค้าใหม่</a> -->
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addCustomerModal">เพิ่มรายการใหม่</button>
                <!-- Modal -->
                <div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModelLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="addCustomerModelLabel">เพิ่มลูกค้าใหม่</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post">

                                    <div class="mb-3">
                                        <label class="form-label">ว/ด/ป</label>
                                        <input type="date" class="form-control" name="deliveryDate" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">ชื่อลูกค้า</label>
                                        <input type="text" class="form-control" name="order_customerName_ref" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">ชื่อคนรับ</label>
                                        <input type="text" class="form-control" name="order_receiverName" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">เบอร์คนรับ</label>
                                        <input type="text" class="form-control" name="order_receiverPhone" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">การชำระเงิน</label>
                                        <input type="text" class="form-control" name="order_payment" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">สถานที่นัดรับ</label>
                                        <textarea class="form-control" name="order_pickupLocation" rows="3" required></textarea>
                                        <!-- <input type="" class="form-control" name="order_pickupLocation"> -->
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">รายละเอียด</label>
                                        <input type="text" class="form-control" name="description" required>
                                    </div>

                                    <div>
                                        <button type="submit" name="action" value="edit" class="btn btn-primary">บันทึก</button>
                                    </div>
                                </form>
                            </div>
                        </div> <!--End modal-content -->
                    </div>
                </div> <!--End modal-fade -->
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
                            <?php //แปลงวันที่
                            $originalDate = $row['deliveryDate'];
                            $formattedDate = date("d/m/Y", strtotime($originalDate));
                            ?>
                            <tr>
                                <!-- $row['ชื่อของคอลลัมภ์ในฐานข้อมูล ที่จะดึงข้อมูลมาแสดง'] -->
                                <td><?= $formattedDate ?></td>
                                <td><?= $row['order_customerName_ref']; ?></td>
                                <td><?= $row['order_receiverName']; ?></td>
                                <td><?= $row['order_receiverPhone']; ?></td>
                                <td><?= $row['order_payment']; ?></td>
                                <td><?= $row['order_pickupLocation']; ?></td>
                                <td><?= $row['description']; ?></td>
                                <td class="text-center"><a href="#" class="btn btn-warning btn-sm">แก้ไข</a></td>
                                <td class="text-center"><a href="#" class="btn btn-danger btn-sm">ลบ</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>