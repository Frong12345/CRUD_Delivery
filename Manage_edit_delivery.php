<?php 
require_once 'config/condb.php';

// คิวรี่ข้อมูลมาแสดงในฟอร์มแก้ไข
// รับค่า POST มาจาก Tag FORM ของ button แก้ไข ที่มี ค่าใน array = id=... และ act=edit
if(isset($_POST['id'])){
    $stmtDataEdit = $condb->prepare("SELECT * FROM tb_customer WHERE id=:id");
     //bindparam STR // INT
     $stmtDataEdit->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
     $stmtDataEdit->execute();
     $editData = $stmtDataEdit->fetch(PDO::FETCH_ASSOC);

    //  echo $stmtDataEdit->rowCount();
    
      //นับจำนวนการคิวรี่
      if($stmtDataEdit->rowCount() !=1){ // ใช้ rowCount นับจำนวน row  ว่ามีค่าid = 1 มั้ย ถ้ามากกว่า 1 คือมีค่าidซ้ำ และให้หยุดการทำงาน
          exit();
      }
}//isset

//ถ้ามีค่าส่งมาจาก Form
if(isset($_POST['id']) && isset($_POST['action']) && $_POST['action'] == 'edit'){

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit();

//trigger exception in a "try" block
try {
    
    //ประกาศตัวแปรรับค่าจาก Form
    $id = $_POST['id'];
    $customerName = $_POST['customerName'];
    $customerPhone = $_POST['customerPhone'];
    $customerCompany = $_POST['customerCompany'];
    $customerAddress = $_POST['customerAddress'];
    $receiverName = $_POST['receiverName'];
    $receiverPhone = $_POST['receiverPhone'];

    // SQL Update
    $stmtUpdate = $condb->prepare("UPDATE tb_customer SET
                                    customerName=:customerName,
                                    customerPhone=:customerPhone,
                                    customerCompany=:customerCompany,
                                    customerAddress=:customerAddress,
                                    receiverName=:receiverName,
                                    receiverPhone=:receiverPhone

                                    WHERE id = :id
                                ");

    //binbparam STR // INT
    $stmtUpdate->bindparam(':id', $id, PDO::PARAM_INT);
    $stmtUpdate->bindparam(':customerName', $customerName, PDO::PARAM_STR);
    $stmtUpdate->bindparam(':customerPhone', $customerPhone, PDO::PARAM_STR);
    $stmtUpdate->bindparam(':customerCompany', $customerCompany, PDO::PARAM_STR);
    $stmtUpdate->bindparam(':customerAddress', $customerAddress, PDO::PARAM_STR);
    $stmtUpdate->bindparam(':receiverName', $receiverName, PDO::PARAM_STR);
    $stmtUpdate->bindparam(':receiverPhone', $receiverPhone, PDO::PARAM_STR);

    if ($stmtUpdate->execute()) {
        echo '<script>
             setTimeout(function() {
              swal({
                  title: "บันทึกข้อมูลสำเร็จ",
                  type: "success"
              }, function() {
                  window.location = "manage_customer.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
    }
} catch (Exception $e) {
    echo 'Message: '. $e->getMessage();
    exit();
    echo '<script>
             setTimeout(function() {
              swal({
                  title: "เกิดข้อผิดพลาด",
                  text: "กรุณาติดต่อผู้ดูแลระบบ",
                  type: "error"
              }, function() {
                  window.location = "manage_customer.php";
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

    <div class="container">
        <div class="row mt-5">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
            <h3>ฟอร์มแก้ไขข้อมูลลูกค้า</h3>
                <form action="" method="post">

                    <div class="mb-3">
                        <label class="form-label">ชื่อ-สกุล</label>
                        <input type="text" class="form-control" name="customerName" required value="<?= $editData['customerName'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">เบอร์โทร</label>
                        <input type="text" class="form-control" name="customerPhone" required value="<?=$editData['customerPhone']?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">บริษัท</label>
                        <input type="text" class="form-control" name="customerCompany" required value="<?=$editData['customerCompany']?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">ที่อยู่</label>
                        <input type="text" class="form-control" name="customerAddress" required value="<?=$editData['customerAddress']?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">ชื่อคนรับของ</label>
                        <input type="text" class="form-control" name="receiverName" required value="<?=$editData['receiverName']?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">เบอร์คนรับของ</label>
                        <input type="text" class="form-control" name="receiverPhone" required value="<?=$editData['receiverPhone']?>">
                    </div>

                    <div>
                        <input type="hidden" name="id" value="<?=$editData['id']?>">
                        <button type="submit" name="action" value="edit" class="btn btn-primary">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>

</html>