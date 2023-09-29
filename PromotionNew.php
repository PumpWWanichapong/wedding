<?php include 'Header_Admin.php'; 
      include 'DBcontext.php';

?>


                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <br>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">ข้อมูลโปรโมชั้น</h6>
                        </div>

                        <div class="card-body">
                            <form action="UpPromotion.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label  class="form-label">วันที่เริ่ม</label>
                                        <input type="date" class="form-control" name="PromotionStartDate" id="" value="" >
                                    </div>
                                    <div class="col-md-4">
                                        <label  class="form-label">วันที่สิ้นสุด</label>
                                        <input type="date" class="form-control" name="PromotionEndDate" id="" value=""  >
                                    </div>
                                </div>
                                <div class="col-12" style="padding-top: 10px;">
                                    <label for="inputAddress" class="form-label">ชื่อโปรโมชั่น</label>
                                    <input type="test" class="form-control" name="PromotionName" id=""  value="">
                                </div>
                                <div class="col-12" style="padding-top: 10px;">
                                    <label for="inputAddress" class="form-label">รายละเอียด</label>
                                    <input type="test" class="form-control" name="PromotionDetail" value=""  >
                                </div>
                                <div class="col-12" style="padding-top: 10px;">
                                    <label  class="form-label">รูปโปรโมชั้น</label>
                                    <input type="file" class="form-control" name="file" id="PromotionFile" onchange="LoadeFile()"   >
                                </div>
                                <br>
                                <div class="row justify-content-md-center">
                        
                                 <input type="submit" name="submit" class="btn btn-primary" value="บันทึก">
                                </div>
                                <br>
                                <div class="Col-12">
                                    <br>
                                    <img class="mySlides" src="" id="output"  >
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
