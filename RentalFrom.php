<?php include 'Header.php';
   
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <br>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">บันทึกการเช่าชุด</h6>
            
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        
                        <div class="card-body">
                            <?php
                            $sql = "SELECT * FROM `order` INNER JOIN orderdetail ON
                            `order`.`OID` = orderdetail.OID 
                            INNER JOIN product on product.PID = orderdetail.PID
                            WHERE `order`.`AccountID` = $AccountCode AND `order`.`OrderType` = 'C'";

                            $result = $conn->query($sql);
                            $IdLine = 0; 
                            while ($CartLine = $result->fetch_assoc()) {
                                $IdLine ++;
                                $money_number = number_format($CartLine["ProductPrice"],2,',','.');
                            ?>
                            <div class="row no-gutters align-items-center" id="CartLine_<?php echo $IdLine?>">
                                <div class="row col mr-2">
                                    <div class="col-2">
                                      <?php 
                                        $LinePID = $CartLine["PID"];
                                        $sqlFile = "SELECT * FROM `fliedoc` WHERE PID = $LinePID";
                                        $resultFile = $conn->query($sqlFile);
                                        $DataFile = $resultFile->fetch_assoc();
                                      ?>  
                                     <img style="width:70%;" src="Photo/<?php echo $DataFile["FileURL"]?>" class="rounded mx-auto d-block" >
                                    </div>
                                    <div class="col-5">
                                        <label> <?php echo $CartLine["ProductName"] ?></label>
                                    </div>
                                    <div class="col-5">
                                        <input type="text" id="ProductPrice_<?php echo $CartLine["ODID"] ?>" name="ProductPrice" value="<?php echo $CartLine["ProductPrice"]?>" hidden>
                                        <input type="text" id="ODID_<?php echo $CartLine["ODID"] ?>" name="ODID" value="<?php echo $CartLine["ODID"]?>" hidden>
                                        <label><?php echo $money_number ?></label>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="row">
                                      <div class="col-5" style="padding: 0px 0px 10px 0px;">
                                       <input type="text" style="width: 40px;" id="Amount_<?php echo $CartLine["ODID"] ?>" name="Amount" onkeyup="Amount()" value="<?php echo $CartLine["Amount"] ?>" >
                                      </div>
                                      <div class="col-5" onclick="DeleteCaert(<?php echo $IdLine?>,<?php echo $CartLine["ODID"] ?>)">
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <?php } ?>
                        </div>
</div>
                    <div class="col-6">
                        <form action="Controller/RentalDB.php" method="post" enctype="multipart/form-data">
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label >วันที่เริ่มเช่า</label>
                                        <input type="Date" class="form-control form-control-user" name="StartDate" >
                                    </div>
                                    <div class="col-sm-6">
                                        <label >ถึง</label>
                                        <input type="Date" class="form-control form-control-user" name="EndDate" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label >วันที่ลองชุด</label>
                                        <input type="Date" class="form-control form-control-user" name="AttemptDate" >
                                    </div>
                                    <div class="col-sm-6">
                                        <label >เวลา</label>
                                        <input type="time" class="form-control form-control-user" name="AttemptTemp"  >
                                    </div>
                                </div>
                                
                            
                            <br><hr><br>
                            <div class="row justify-content-md-center">
                                <div class="col-3">
                                    <!-- <a href="Home.php" class="btn btn-primary btn-user btn-block">
                                    บันทึกเสร็จสิ้น
                                    </a> -->
                                    <input type="submit" class="btn btn-primary btn-user btn-block" value="บันทึกเสร็จสิ้น" >
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <script>

    function Product(){
            window.location.assign("HistoryAttemptDetail.php")
    }

    </script>

<?php include 'Foodter.php'; ?>
