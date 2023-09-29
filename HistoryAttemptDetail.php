<?php include 'Header.php'; 
    if (isset($_GET['ID'])) {
        $ID = $_GET['ID'];
        $sql = "SELECT * FROM `attempt` T INNER JOIN account A on T.AccountID = A.AccountID WHERE T.AID = $ID ";

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
                <h6 class="m-0 font-weight-bold text-primary">ข้อมูลการลองชุด</h6>
            </div>

            <div class="card-body">
                <form action="Controller\AttemptDB.php" method="post">
                   <input type="text" name="AID" value="<?php echo $Data["AID"] ?>" hidden >
                   <input type="text" id="AccountID" name="AccountID" value="<?php echo $Data["AccountID"] ?>" hidden>
                    <div class="row">
                        <div class="col-md-6">
                            <label  class="form-label">ผู้เช่า</label>
                            <div class="input-group">
                                <input type="text" class="form-control" disabled style="background: white" id="AccountName" value="<?php echo $Data["Prefix"] ." ".  $Data["Name"] . " " . $Data["LastName"] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">เบอร์โทร</label>
                            <input type="text" class="form-control" disabled style="background: white" id="PhoneNo"  value="<?php echo $Data["PhoneNo"] ?>" >
                        </div>
                    </div>

                    <div class="col-12" style="padding-top: 10px;">
                        <label class="form-label">ที่อยู่</label>
                        <input type="text" class="form-control" id="Address"  value="<?php echo $Data["Address"] ?>" >
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="padding-top: 10px;">
                            <label  class="form-label">วันที่</label>
                            <input type="date" class="form-control" id="" name="AttemptDate"  value="<?php echo $Data["AttemptDate"] ?>">
                        </div>
                        <div class="col-md-6" style="padding-top: 10px;">
                            <label  class="form-label">เวลา</label>
                            <input type="time" class="form-control" id="" name="AttemptTemp"  value="<?php echo $Data["AttemptTemp"] ?>">
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="Line_0">

                                    </tr>

                                    <?php
                                        $sqlLine = "SELECT * FROM `attemptdetail` T INNER JOIN product P ON T.PID = P.PID WHERE T.AID = $ID";
                                        $result = $conn->query($sqlLine);
                                            while ($rowline = $result->fetch_assoc()) {
                                    ?>
                                    <tr onclick="ProductLi(<?php echo  $rowline["ADID"] ?>)" >
                                    <?php 
                                        $LinePID = $rowline["PID"];
                                        $sqlFile = "SELECT * FROM `fliedoc` WHERE PID = $LinePID";
                                        $resultFile = $conn->query($sqlFile);
                                        $DataFile = $resultFile->fetch_assoc();
                                      ?>  
                                        <td style="width:100px;"> <img style="width:100px;" src="Photo/<?php echo $DataFile["FileURL"]?>" class="rounded mx-auto d-block"> </td>
                                        <td><?php echo  $rowline["ProductName"] ?></td>
                                        <td><?php echo  $rowline["Zise"] ?></td>
                                        <td><?php echo  $rowline["Amount"] ?> ชุด
                                          <input type="text" hidden class="Amount" name="PIDLine" id="PID_<?php echo $rowline["ADID"]?>"  value="<?php echo $rowline["PID"]?>">
                                          <input type="text" hidden class="Amount" name="NumberLine" id="NumberLine_<?php  echo $rowline["ADID"]?>" value="<?php  echo $rowline["Amount"]?>">
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-md-center">
                     <button class="btn btn-secondary" onclick="Close()">ยกเลิก</button>
                </div>

            </div>

        </div>

    </div>
    <!-- /.container-fluid -->

    <script>
    function Close(){
       window.location.assign("HistoryAttempt.php");
    }
    </script>


<?php include 'Foodter.php'; ?>
