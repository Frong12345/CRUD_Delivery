<?php
if (isset($_POST['customerName']) && isset($_POST['action']) && $_POST['action'] == 'add') {

    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
    // exit();

    //ไฟล์เชื่อมต่อฐานข้อมูล
    require_once 'config/condb.php';

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
                  window.location = "customer.php"; //หน้าที่ต้องการให้กระโดดไป
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
                            window.location = customer.php;
                        });
                        }, 1000);
                    </script>';
    }  //catch
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
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <h3 class="text-center">ฟอร์มเพิ่มข้อมูลลูกค้า</h3>

                <form action="" method="post" class="mt-4">

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

                    <div class="text-center">
                        <button type="submit" name="action" value="add" class="btn btn-primary w-100">บันทึก</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>