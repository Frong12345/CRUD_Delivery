<?php
//ไฟล์เชื่อมต่อฐานข้อมูล
require_once 'config/condb.php';

if (isset($_POST['customerName']) && isset($_POST['action']) && $_POST['action'] == 'add') {

    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
    // exit();

    try {

        //ประกาศตัวแปรรับค่าจากฟอร์ม
        $customerName = $_POST['customerName'];
        $customerPhone = $_POST['customerPhone'];
        $customerCompany = $_POST['customerCompany'];
        $customerAddress = $_POST['customerAddress'];
        $receiverName = $_POST['receiverName'];
        $receiverPhone = $_POST['receiverPhone'];

        //sql insert
        $stmtinsert = $condb->prepare("INSERT tb_customer
        
        (customerName,customerPhone,customerCompany,
        customerAddress,receiverName,receiverPhone
        )

        VALUES

        (:customerName,:customerPhone,:customerCompany,
        :customerAddress,:receiverName,:receiverPhone
        )

        ");

        //bindparam STR // INT
        $stmtinsert->bindparam(':customerName', $customerName, PDO::PARAM_STR);
        $stmtinsert->bindparam(':customerPhone', $customerPhone, PDO::PARAM_STR);
        $stmtinsert->bindparam(':customerCompany', $customerCompany, PDO::PARAM_STR);
        $stmtinsert->bindparam(':customerAddress', $customerAddress, PDO::PARAM_STR);
        $stmtinsert->bindparam(':receiverName', $receiverName, PDO::PARAM_STR);
        $stmtinsert->bindparam(':receiverPhone', $receiverPhone, PDO::PARAM_STR);

        //ถ้า stmtinsert ทำงานถูกต้อง 
        if ($stmtinsert->execute()) {
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
        } //if

    } //catch exception
    catch (Exception $e) {
        // echo 'Message: ' .$e->getMessage();
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
    }  //catch
} //isset


$stmt = $condb->prepare("SELECT * FROM tb_customer");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

                <h2>จัดการลูกค้า</h2>
                <!-- <a href="customer_add.php" class="btn btn-info mb-3">เพิ่มลูกค้าใหม่</a> -->
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addCustomerModal">เพิ่มลูกค้าใหม่</button>
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
                                        <label class="form-label">ชื่อ-สกุล</label>
                                        <input type="text" class="form-control" name="customerName" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">เบอร์โทร</label>
                                        <input type="text" class="form-control" name="customerPhone" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">บริษัท</label>
                                        <input type="text" class="form-control" name="customerCompany" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">ที่อยู่</label>
                                        <input type="text" class="form-control" name="customerAddress" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">ชื่อคนรับของ</label>
                                        <input type="text" class="form-control" name="receiverName" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">เบอร์คนรับของ</label>
                                        <input type="text" class="form-control" name="receiverPhone" required>
                                    </div>

                                    <div>
                                        <button type="submit" name="action" value="add" class="btn btn-primary">บันทึก</button>
                                    </div>
                                </form>
                            </div>
                        </div> <!--End modal-content -->
                    </div>
                </div> <!--End modal-fade -->

                <table class="table table-striped  table-hover table-bordered table-sm">
                    <thead class="table-success text-center">
                        <tr>
                            <th>ชื่อ</th>
                            <th>เบอร์โทร</th>
                            <th>บริษัท</th>
                            <th>ที่อยู่</th>
                            <th>คนรับของ</th>
                            <th>เบอร์คนรับของ</th>
                            <th colspan="2">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- foreach ดึงข้อมูลแต่ละแถวมาแสดงผล โดยกำหนด $row เป็นแถวแต่ละแถว -->
                        <?php foreach ($result as $row) { ?>
                            <tr>
                                <!-- $row['ชื่อของคอลลัมภ์ในฐานข้อมูล ที่จะดึงข้อมูลมาแสดง'] -->
                                <td><?= $row['customerName']; ?></td>
                                <td><?= $row['customerPhone']; ?></td>
                                <td><?= $row['customerCompany']; ?></td>
                                <td><?= $row['customerAddress']; ?></td>
                                <td><?= $row['receiverName']; ?></td>
                                <td><?= $row['receiverPhone']; ?></td>
                                <td> <!-- Start Edit -->
                                     <form action="edit_customer.php" method="POST">
                                        <input type="hidden" name="id" value="<?=$row['id']?>">
                                        <input type="hidden" name="act" value="edit">
                                        <button type="submit" class="btn btn-warning btn-sm">แก้ไข</button>
                                     </form>
                                </td> <!-- End Edit -->
                                <td> <!-- Start Delete -->
                                     <form action="delete_customer.php" method="POST">
                                        <input type="hidden" name="id" value="<?=$row['id']?>">
                                        <input type="hidden" name="act" value="delete">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบข้อมูล !!');">ลบ</button>
                                     </form>
                                </td> <!-- End Delete -->
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