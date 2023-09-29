<?php include 'Header_Admin.php';
      include 'DBcontext.php';

      $sql = "SELECT  * FROM Promotion ";
      $result = $conn->query($sql);
?>


                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <br>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">ข้อมูลโปรโมชัน</h6>
                            <div class="dropdown no-arrow">
                            <button class="btn btn-success btn-icon-split" onclick="From()" >
                                <span class="icon text-white-50">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <span class="text">เพิ่ม</span>
                            </button>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="TbProduct" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ชื่อโปรโมชั่น</th>
                                            <th>รายละเอียด</th>
                                            <th>วันที่เริ่ม</th>
                                            <th>วันที่สิ้นสุด</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <tr onclick="Product(<?php echo $row["PromotionID"] ?>)" >
                                            <td><?php echo $row["PromotionName"] ?></td>
                                            <td><?php echo $row["PromotionDetail"] ?></td>
                                            <td><?php echo $row["PromotionStartDate"] ?></td>
                                            <td><?php echo $row["PromotionEndDate"] ?></td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->


    <script>

     let table = new DataTable('#TbProduct');

    function Product(e){
            window.location.assign("PromotionDetail.php?ID="+e+"")

    }

    function From(){
            window.location.assign("PromotionNew.php")
    }

    </script>


<?php include 'Foodter.php'; ?>
