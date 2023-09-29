<?php include 'Header_Admin.php';
       include 'DBcontext.php';

       $sql = "SELECT O.OID, O.AccountID, O.OrderPrice, O.OrderAmount, O.StartDate, O.EndDate, O.ReturnDate , A.Prefix , A.Name , A.LastName , A.Address, A.PhoneNo ,A.Email ,
               (SELECT SUM(Amount) as Amount FROM orderdetail WHERE OID = O.OID) as TotalAmount
               FROM `order` O INNER JOIN account A ON O.AccountID = A.AccountID;";

       $result = $conn->query($sql);
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <br>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">ข้อมูลการลองชุด</h6>
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
                                            <th>วันที่ลองชุด</th>
                                            <th>ช่วงเวลา</th>
                                            <th>ชื่อ - นามสกุล</th>
                                            <th>จำนวนชุด</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        $sql = "SELECT (SELECT SUM(Amount) FROM attemptdetail WHERE AID = T.AID) as TotalAmount , T.AID, T.AccountID, T.AttemptDate, T.AttemptTemp ,A.Prefix , A.Name, A.LastName FROM attempt T
                                                INNER JOIN account A ON T.AccountID = A.AccountID";
                                        $result = $conn->query($sql);
                                        while ($row = $result->fetch_assoc()) {
                                       ?>
                                        <tr onclick="Product(<?php echo $row["AID"]?>)" >
                                            <td><?php echo $row["AttemptDate"]?></td>
                                            <td><?php echo $row["AttemptTemp"]?></td>
                                            <td><?php echo $row["Prefix"] ." ".  $row["Name"] . " " . $row["LastName"]?> </td>
                                            <td><?php echo $row["TotalAmount"]?> ชุด</td>
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
       window.location.assign("AttemptDetail.php?ID="+e+"")
    }

    function From(){
       window.location.assign("AttemptFrom.php")
    }

    </script>


<?php include 'Foodter.php'; ?>
