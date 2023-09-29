<?php include 'Header_Admin.php';
      include 'DBcontext.php';



      $sql = "SELECT  * FROM Account ";
      $result = $conn->query($sql);
?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <br>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">ข้อมูลสมาชิก</h6>
                        <div class="dropdown no-arrow">
                            <button class="btn btn-success btn-icon-split" onclick="From()" >
                                <span class="icon text-white-50">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <span class="text">เพิ่มสมาชิก</span>
                            </button>
                        </div>
                    </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="TbProduct" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ชื่อ-นามสกุล</th>
                                            <th>Email</th>
                                            <th>เบอร์โทรศัพท์</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                                $sql = "SELECT AccountID, Prefix, Name, LastName, Address, PhoneNo, Email, AccountType FROM Account"; // Replace with your actual table and column names
                                                $result = $conn->query($sql);
                                                    while ($row = $result->fetch_assoc()) {
                                        ?>

                                        <tr onclick="Product(<?php echo  $row["AccountID"] ?>)" >
                                            <td><?php echo $row["Prefix"] ." ".  $row["Name"] . " " . $row["LastName"] ?></td>
                                            <td><?php echo $row["Email"] ?></td>
                                            <td><?php echo $row["PhoneNo"] ?></td>
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
            window.location.assign("AccountDetail.php?ID="+e+"")
    }

    function From(){
            window.location.assign("AccountFrom.php")
    }

    </script>


<?php
include 'Foodter.php'; ?>
