<?php include 'Header_Admin.php';
      include 'DBcontext.php';

      if (isset($_GET['ID'])) {
        $ID = $_GET['ID'];

        $sql = "SELECT O.OID, O.AccountID, O.OrderPrice, O.OrderAmount, O.StartDate, O.EndDate, O.ReturnDate , A.Prefix , A.Name , A.LastName , A.Address, A.PhoneNo ,A.Email, O.Bill
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
                        <div class="col-md-6">
                            <label  class="form-label">ผู้เช่า</label>
                            <div class="input-group">
                                <input type="text" class="form-control" disabled style="background: white" id="AccountName" value="<?php echo $Data["Prefix"] ." ".  $Data["Name"] . " " . $Data["LastName"] ?>" >
                                <div class="input-group-prepend" data-bs-toggle="modal" href="#AccountLine"> <span class="input-group-text"><i class="fas fa-search"></i></span> </div>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding-top: 10px;>
                            <label class="form-label">เบอร์โทรศัพท์</label>
                            <input type="text" class="form-control" disabled style="background: white" id="PhoneNo"  value="<?php echo $Data["PhoneNo"] ?>" >
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">ราคารวม</label>
                            <input type="text" class="form-control" id="OrderPrice"  name="OrderPrice" value="<?php echo $Data["OrderPrice"] ?>" >
                        </div>
                    </div>

                    <div class="col-9" style="padding-top: 10px;">
                        <label class="form-label">ที่อยู่</label>
                        <input type="text" class="form-control" id="Address" value="<?php echo $Data["Address"] ?>" >
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4" style="padding-top: 10px;">
                            <label  class="form-label">วันที่เช่า</label>
                            <input type="date" class="form-control" id="" name="StartDate"  value="<?php echo $Data["StartDate"] ?>">
                        </div>
                        <div class="col-md-4" style="padding-top: 10px;">
                            <label  class="form-label">ถึงวันที่</label>
                            <input type="date" class="form-control" id="" name="EndDate"  value="<?php echo $Data["EndDate"] ?>">
                        </div>
                        <div class="col-md-4" style="padding-top: 10px;">
                            <label  class="form-label">วันที่คืน</label>
                            <input type="date" class="form-control" id="" name="ReturnDate"  value="<?php echo $Data["ReturnDate"] ?>">
                        </div>
                        <input type="text" name="Json" id="Json" hidden >
                        <input type="submit" name="Update" id="Submit" hidden>
                    </div>


                </form>

                <br>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="m-0 font-weight-bold text-primary">หลักฐานการโอนเงิน</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-md-center">
                         <div class="">
                            <?php if($Data["Bill"] != null && $Data["Bill"] != ''){  ?>
                            <img style="width:300px;" src="Photo/<?php echo $Data["Bill"]?>"  >
                            <?php }?>
                         </div>
                        </div>
                    </div>
                </div>
                <br>

                <br>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-6">
                            <h6 class="m-0 font-weight-bold text-primary">ข้อมูลชุด</h6>
                            </div>
                            <div class="col-6 row justify-content-end">
                                <button class="btn btn-success btn-icon-split" data-bs-toggle="modal" href="#exampleModalToggle">
                                    <span class="icon text-white-50">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <span class="text">เพิ่ม</span>
                                </button>
                            </div>
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
                                        <td style="width:100px;"> <img style="width:100px;" src="Photo/<?php echo $DataFile["FileURL"]?>" class="rounded mx-auto d-block" > </td>
                                        <td><?php echo  $rowline["ProductName"] ?></td>
                                        <td><?php echo  $rowline["Zise"] ?></td>
                                        <td><?php echo  $rowline["Amount"] ?></td>
                                        <td><?php echo  $rowline["Price"] ?>
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
                     <button type="submit" class="btn btn-primary" onclick="Submit()">บันทึก</button>&nbsp;&nbsp;
                     <button type="submit" class="btn btn-secondary" onclick="Close()">ยกเลิก</button>

                </div>

            </div>

        </div>

    </div>
    <!-- /.container-fluid -->

    <!-- Model 1 -->
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">ชุด</h5>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-hover" id="TbProduct" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ชื่อ</th>
                                <th>ประเภท</th>
                                <th>ราคา</th>
                                <th>ไซค์</th>
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
                                <td><?php echo  $row["ProductPrice"] ?></td>
                                <td><?php echo  $row["Zise"] ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" id="CloseItem"  data-bs-dismiss="modal" >ยกเลิก</button>
                    <button class="btn btn-primary" hidden data-bs-target="#exampleModalToggle2" id="OpneNumber" data-bs-toggle="modal" data-bs-dismiss="modal">Open second modal</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Model 2 -->
    <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">จำนวนชุด</h5>
                </div>
                <div class="modal-body">
                    <input type="text" id="OrderID" hidden>
                    <div class="col-12" style="padding-top: 10px;">
                        <label  class="form-label">จำนวน</label>
                        <input type="number" class="form-control" id="Amount" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="AddOrder()">เพิ่ม</button>
                    <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">ยกเลิก</button>
                    <button class="btn btn-primary" hidden id="CloesM2"  data-bs-dismiss="modal"></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Model 1 -->
    <div class="modal fade" id="AccountLine" aria-hidden="true"  aria-labelledby="AccountLine" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ข้อมูลสมาชิก</h5>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-hover" id="TbAccunt" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ชื่อ</th>
                                <th>Email</th>
                                <th>เบอร์โทร</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT  * FROM account ";
                                $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr onclick="AddAccount(<?php echo  $row["AccountID"] ?>,'<?php echo  $row["Prefix"] . $row["Name"] . $row["LastName"]?>','<?php echo  $row["Address"] ?> ' )" >
                                <td><?php echo  $row["Prefix"] . $row["Name"] . $row["LastName"]?></td>
                                <td><?php echo  $row["Email"] ?></td>
                                <td><?php echo  $row["PhoneNo"] ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" id="CloseAccount"   data-bs-dismiss="modal" >ยกเลิก</button>
                </div>
            </div>
        </div>
    </div>



    <script>

    let table = new DataTable('#TbAccunt')

     function Product(e){
        $("#OrderID").val(e);
        $("#OpneNumber").click();
     }

     function AddOrder(){
        var Number = $("#Amount").val();
        var OrderID = $("#OrderID").val();

            $.ajax({
            type: "POST",
            url: "Component/_FromOrder.php",
            data: {ID : OrderID ,Number : Number },
            success: function(response) {

              document.getElementById("Line_0").insertAdjacentHTML("afterend", response);
              $("#CloesM2").click();
              $("#Amount").val("");
              SunAmount()
            }
           });
     }

     function AddAccount(e,name,Address){
        $("#AccountID").val(e);
        $("#AccountName").val(name);
        $("#Address").val(Address);
        $("#CloseAccount").click();
     }

     var DataSet = [];

     function SunAmount(){
        var Total = 0;
        $.each($("input[name='AmountLine']:text"), function () {
          Total = Total + parseInt(this.value);
          $("#OrderPrice").val(Total)
       });

    }

    function Submit(){

      $.each($("input[name='AmountLine']:text"), function () {

        var FID = this.id.split("_")[1];
        var PID = $("#PID_" + FID).val();
        var Amount = $("#NumberLine_" + FID).val();

        DataSet.push({ PID : PID ,
                       Amount : Amount ,
                       Price :  this.value
                   });

       $("#Json").val(JSON.stringify(DataSet));

       $("#Submit").click();

      });


    }

    function Close(){
       window.location.assign("History.php");
    }


    </script>


<?php include 'Foodter.php'; ?>
