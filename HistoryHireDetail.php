<?php include 'Header.php';

if (isset($_GET['ID'])) {
    $ID = $_GET['ID'];

    $sql = "SELECT O.OID, O.AccountID, O.OrderPrice, O.OrderAmount, O.StartDate, O.EndDate, O.ReturnDate , A.Prefix , A.Name , A.LastName , A.Address, A.PhoneNo ,A.Email
            FROM `order` O INNER JOIN account A ON O.AccountID = A.AccountID WHERE O.OID = $ID";

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
                <h6 class="m-0 font-weight-bold text-primary">ข้อมูลการเช่า</h6>
            </div>

            <div class="card-body">
                <form action="Controller\Order.php" method="post">
                   <input type="text" name="OID" value="<?php echo $Data["OID"] ?>" hidden >
                    <input type="text" id="AccountID" name="AccountID" value="<?php echo $Data["AccountID"] ?>" hidden>
                    <div class="row">
                        <div class="col-md-5">
                            <label  class="form-label">ผู้เช่า</label>
                            <div class="input-group">
                                <input type="text" class="form-control" disabled style="background: white" id="AccountName" value="<?php echo $Data["Prefix"] ." ".  $Data["Name"] . " " . $Data["LastName"] ?>" >
                                <!-- <div class="input-group-prepend" data-bs-toggle="modal" href="#AccountLine"> <span class="input-group-text"><i class="fas fa-search"></i></span> </div> -->
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">ราคารวม(บาท)</label>
                            <input type="text" class="form-control" id="OrderPrice"  name="OrderPrice" value="<?php echo $Data["OrderPrice"] ?> " >
                        </div>
                    </div>
<div class="row">
                    <div class="col-6" style="padding-top: 10px;">
                        <label class="form-label">ที่อยู่</label>
                        <input type="text" class="form-control" id="Address" value="<?php echo $Data["Address"] ?>" >
                    </div>
                    <div class="col-md-4" style="padding-top: 10px;>
                            <label class="form-label">เบอร์โทรศัพท์</label>
                            <input type="text" class="form-control" id="PhoneNo"  value="<?php echo $Data["PhoneNo"] ?>" >
                        </div>
                        <div class="col-md-4" style="padding-top: 10px;">
                            <label  class="form-label">วันที่เช่า</label>
                            <input type="date" class="form-control" id="" name="StartDate"  value="<?php echo $Data["StartDate"] ?>">
                        </div>
                        <div class="col-md-4" style="padding-top: 10px;">
                            <label  class="form-label">ถึงวันที่</label>
                            <input type="date" class="form-control" id="" name="EndDate"  value="<?php echo $Data["EndDate"] ?>">
                        </div>
                        <input type="text" name="Json" id="Json" hidden >
                        <input type="submit" name="Update" id="Submit" hidden>
                    </div>


                </form>
                <br>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-6">
                            <h6 class="m-0 font-weight-bold text-primary">ข้อมูลชุด</h6>
                            </div>
                            <!-- <div class="col-6 row justify-content-end">
                                <button class="btn btn-success btn-icon-split" data-bs-toggle="modal" href="#exampleModalToggle">
                                    <span class="icon text-white-50">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <span class="text">เพิ่ม</span>
                                </button>
                            </div> -->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover"  width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>ชื่อ</th>
                                        <th>ไซค์</th>
                                        <th>จำนวนชุด</th>
                                        <th>ราคา</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="Line_0">
                                    </tr>
                                    <?php
                                        $sqlLine = "SELECT * FROM `orderdetail` OD INNER JOIN product P ON OD.PID = P.PID WHERE OD.OID = $ID";
                                        $result = $conn->query($sqlLine);
                                            while ($rowline = $result->fetch_assoc()) {
                                    ?>
                                    <tr onclick="ProductLi(<?php echo  $rowline["ODID"] ?>)" >
                                    <?php 
                                        $LinePID = $rowline["PID"];
                                        $sqlFile = "SELECT * FROM `fliedoc` WHERE PID = $LinePID";
                                        $resultFile = $conn->query($sqlFile);
                                        $DataFile = $resultFile->fetch_assoc();
                                      ?>  
                                        <td style="width:100px;"> <img style="width:100px;" src="Photo/<?php echo $DataFile["FileURL"]?>" class="rounded mx-auto d-block" alt="..."> </td>
                                        <td><?php echo  $rowline["ProductName"] ?></td>
                                        <td><?php echo  $rowline["Zise"] ?></td>
                                        <td><?php echo  $rowline["Amount"] ?> ชุด</td>
                                        <td><?php echo  $rowline["Price"] ?> บาท
                                          <input type="text" hidden class="Amount" name="AmountLine" id="AmountLine_<?php  echo $rowline["ODID"]?>" value="<?php  echo $rowline["ProductName"]?>">
                                          <input type="text" hidden class="Amount" name="PIDByLine" id="PID_<?php  echo $rowline["ODID"]?>"  value="<?php  echo $rowline["PID"]?>">
                                          <input type="text" hidden class="Amount" name="NumberLine" id="NumberLine_<?php  echo $rowline["ODID"]?>" value="<?php  echo $rowline["Amount"]?>">
                                        </td>
                                    </tr>

                                    <?php } ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-md-center">
                <button type="submit" class="btn btn-primary" onclick="Close()">บันทึก</button>
                <div>
                     <button type="submit" class="btn btn-secondary" onclick="Close()">ยกเลิก</button>
                </div>

            </div>

        </div>

    </div>
    <!-- /.container-fluid -->

    <script>
    function Close(){
       window.location.assign("HIstoryHire.php");
    }
    </script>


<?php include 'Foodter.php'; ?>
