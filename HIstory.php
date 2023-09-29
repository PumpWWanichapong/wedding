<?php include 'Header_Admin.php';
      include 'DBcontext.php';

      $sql = "SELECT O.OID, O.AccountID, O.OrderPrice, O.OrderAmount, O.StartDate, O.EndDate, O.ReturnDate , A.Prefix , A.Name , A.LastName , A.Address, A.PhoneNo ,A.Email ,
              (SELECT SUM(Amount) as Amount FROM orderdetail WHERE OID = O.OID) as TotalAmount
              FROM `order` O INNER JOIN account A ON O.AccountID = A.AccountID WHERE O.OrderType = 'O' ";

      $result = $conn->query($sql);
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <br>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">ข้อมูลการเช่า</h6>
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
                                            <th>วันที่เช่า</th>
                                            <th>ถึงวันที่</th>
                                            <th>คืนวันที่</th>
                                            <th>ชื่อ - นามสกุล</th>
                                            <th>ราคา</th>
                                            <th>จำนวนชุด</th>
                                            <th>สถานะ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                          $result = $conn->query($sql);
                                          while ($row = $result->fetch_assoc()) {
                                      ?>
                                        <tr onclick="Product(<?php echo $row["OID"]?>)" >
                                            <td><?php echo $row["StartDate"]?></td>
                                            <td><?php echo $row["EndDate"]?> </td>
                                            <td><?php echo $row["ReturnDate"]?> </td>
                                            <td><?php echo $row["Prefix"] ." ".  $row["Name"] . " " . $row["LastName"] ?> </td>
                                            <td><?php echo $row["OrderPrice"]?> บาท</td>
                                            <td><?php echo $row["TotalAmount"]?> ชุด</td>
                                            <td>
                                                <?php 
                                                    if($row["ReturnDate"] != null){
                                                        echo "คืนชุดแล้ว";
                                                    }else{
                                                        echo "ยังไม่คืนชุด";
                                                    }
                                                ?> 
                                            </td>
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
       window.location.assign("HistoryDetail.php?ID="+e+"")
    }

    function From(){
       window.location.assign("HistoryFrom.php")
    }

    </script>


<?php include 'Foodter.php'; ?>
