<?php include 'Header_Admin.php';
      include 'DBcontext.php';
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <br>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">ข้อมูลชุดเช่า</h6>
                            <div class="dropdown no-arrow">
                                <button class="btn btn-success btn-icon-split" onclick="New()" >
                                    <span class="icon text-white-50">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <span class="text">เพิ่มชุดเช่า</span>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="TbProduct" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ชื่อชุด</th>
                                            <th>ประเภทชุด</th>
                                            <th>ราคา(บาท)</th>
                                            <th>ไซค์</th>
                                            <th>จำนวน</th>
                                            <!-- <th>เช่าอยู่</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                           $sql = "SELECT  * FROM Product ";
                                           $result = $conn->query($sql);
                                                while ($row = $result->fetch_assoc()) {
                                      ?>
                                        <tr onclick="Product(<?php echo  $row["PID"] ?>)" >
                                            <td><?php echo  $row["ProductName"] ?></td>
                                            <td><?php echo  $row["ProductType"] ?></td>
                                            <td><?php echo  $row["ProductPrice"] ?> บาท</td>
                                            <td><?php echo  $row["Zise"] ?></td>
                                            <td><?php echo  $row["ProductAmount"] ?> ชุด</td>
                                            <!-- <td>0</td> -->
                                        </tr>
                                      <?php } ?>
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
            window.location.assign("ProductDetail.php?ID="+e+"")

    }

    function New(e){
            window.location.assign("ProductFrom.php")
    }

    </script>


<?php include 'Foodter.php'; ?>
