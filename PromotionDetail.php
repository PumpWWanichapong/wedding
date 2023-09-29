<?php include 'Header_Admin.php';
      include 'DBcontext.php';

      if (isset($_GET['ID'])) {
        $ID = $_GET['ID'];
        $sql = "SELECT * FROM Promotion WHERE PromotionID  = $ID "; // Replace with your actual table and column names
        $result = $conn->query($sql);
        $Data = $result->fetch_assoc();
      }

?>


    <!-- Begin Page Content -->
    <div class="container-fluid">
        <br>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">ข้อมูลโปรโมชัน</h6>
            </div>
            <div class="card-body">
                <form action="Controller/PromotionUpdate.php" method="post" enctype="multipart/form-data" >
                    <input type="text" name="PromotionID" hidden value="<?php  echo $Data["PromotionID"] ?>" >
                    <div class="row">
                        <div class="col-md-6">
                            <label  class="form-label">วันที่เริ่ม</label>
                            <input type="date" class="form-control" id="" name="PromotionStartDate" value="<?php  echo $Data["PromotionStartDate"] ?>" >
                        </div>
                        <div class="col-md-6">
                            <label  class="form-label">วันที่สิ้นสุด</label>
                            <input type="date" class="form-control" id="" name="PromotionEndDate" value="<?php  echo $Data["PromotionEndDate"] ?>"  >
                        </div>
                    </div>
                    <div class="col-12" style="padding-top: 10px;">
                        <label for="inputAddress" class="form-label">ชื่อโปรโมชั่น</label>
                        <input type="test" class="form-control" id="" name="PromotionName" value="<?php  echo $Data["PromotionName"] ?>">
                    </div>
                    <div class="col-12" style="padding-top: 10px;">
                        <label for="inputAddress" class="form-label">รายละเอียด</label>
                        <input type="test" class="form-control" name="PromotionDetail" value="<?php  echo $Data["PromotionDetail"] ?>"  >
                    </div>
                    <div class="col-12" style="padding-top: 10px;">
                        <label  class="form-label">รูปโปรโมชั้น</label>
                        <input type="file" class="form-control" name="file"  id="PromotionFile" onchange="LoadeFile()" >
                    </div>
                    <br>
                    <div class="row justify-content-md-center">
                        <input type="submit" name="submit" class="btn btn-primary"  value="บันทึก"> &nbsp;&nbsp;
                        <input type="submit" name="Delete" class="btn btn-danger" value="ลบ"> &nbsp;&nbsp;
                        <input type="submit" name="Clost"  class="btn btn-secondary" value="ยกเลิก">
                    </div>
                    <br>
                    <div class="Col-12">
                        <img class="mySlides" id="output" src="Photo/<?php  echo $Data["PromotionFile"] ?>" >
                    </div>

                </form>

            </div>

        </div>

    </div>
    <!-- /.container-fluid -->

    <script>

        function LoadeFile(){

        var file = document.getElementById("PromotionFile").files[0];

        var output = document.getElementById('output');
        output.src = URL.createObjectURL(file);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }

        }

    </script>


<?php include 'Foodter.php'; ?>
