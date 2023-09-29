<?php include 'Header.php';

if (isset($AccountCode)) {



    $sqlOrder = "SELECT * FROM `order` INNER JOIN orderdetail ON
    `order`.`OID` = orderdetail.OID 
    INNER JOIN product on product.PID = orderdetail.PID
    WHERE `order`.`AccountID` = $AccountCode AND `order`.`OrderType` = 'C'";

    $resultOrder = $conn->query($sqlOrder);
    $DataOrder = $resultOrder->fetch_assoc();
}

?>

<input type="text" value="<?php echo $DataOrder["OID"] ?>" id="OID" hidden>

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">รายการที่เช่า</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="col-12">
                    <div class="card border-left-primary shadow h-100 py-2">
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
                                       <i class="fas fa-trash fa-2x text-gray-300"></i>
                                      </div>

                                    </div>
                                </div>
                            </div>
                            <hr>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">สรุป</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div>
                    <h5>ที่อยู่</h5>
                    <br>
                    <label> 122/33</label>
                    <br><hr>
                    <h4>สรุปรายการเช่า</h4>
                    <br>
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <label> ยอดรวม</label>
                        </div>
                        <div class="col-auto">
                            <label id="SumAmount"> 1,000</label>
                        </div>
                    </div>
                    <!-- <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <label> ค่ามัดจำ</label>
                        </div>
                        <div class="col-auto">
                            <label>500</label>
                        </div>
                    </div> -->
                    <!-- <hr>
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <label> ยอดรวม</label>
                        </div>
                        <div class="col-auto">
                            <label>1,500</label>
                        </div>
                    </div> -->
                    <br>

                    <div class="row justify-content-md-center">
                        <button class="btn btn-primary btn-icon-split" style="width: 80%;" onclick="Submit()">
                          <span class="text">ดำเนินการชำระเงินต่อไป</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'Foodter.php'; ?>

<script>
    function DeleteCaert(e,id){

        Swal.fire({
            title: 'คุณแน่ใจว่าลบชุดเช่านี้ในตะกร้าใช่ไหม?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่, ลบเลย!'

            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
				   type: "POST",
				   url: "Controller/CartBuy.php",
				   data: "Type=Delete&ODID="+id+"",
				   success: function(msg){
                       window.location.assign("Cart.php")
				   }
				 });

            }
        })

    }

    function Amount(){
        SumTotal();
    }

    function SumTotal(){

        var TatalAmount = 0;
        $.each($("input[name='Amount']:text"), function () {
        var sid = this.id.split("_")[1];
        var ProductPrice = $("#ProductPrice_" + sid).val();
        var SunAmount = this.value * parseFloat(ProductPrice);
        TatalAmount = TatalAmount + SunAmount;

        });

        $("#SumAmount").html(PatMony(TatalAmount.toFixed(2)));
    }

    SumTotal();

    var CartList = [];

    function Submit(){
        var Total = 0;
        var OrderAmount = 0;
        $.each($("input[name='Amount']:text"), function () {
            var odid = this.id.split("_")[1];
            var ProductPrice = $("#ProductPrice_" + odid).val();
            var SunAmount = this.value * parseFloat(ProductPrice);
                CartList.push({ODID : parseInt(odid),
                            Amount: this.value,
                            ProductPrice : ProductPrice,
                            SunAmount : SunAmount
                            });
                Total = Total + SunAmount;
                OrderAmount = OrderAmount + parseInt(this.value);
        });

        var oid = $("#OID").val();

        $.ajax({
            type: "POST",
            url: "Controller/CartBuy.php",
            data: "Type=Submit&jsonData="+JSON.stringify(CartList)+"&OrderPrice="+Total+"&OID="+oid+"&OrderAmount="+OrderAmount+"",
            success: function(msg){
               window.location.assign("Bill.php")
            }
        });

    }

function PatMony(e) {
    var Respont = "";
    e = e.replace(/[^0-9\.-]/g, '');
    var num = e.replace(/\,/g, '');
    if (!isNaN(num)) {
        if (num.indexOf('.') > -1) {
            num = num.split('.');
            num[0] = num[0].toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g, '$1,').split('').reverse().join('').replace(/^[\,]/, '');
            if (num[1].length > 2) {
                num[1] = num[1].substring(0, num[1].length - 1);
            }
            Respont = num[0] + '.' + num[1];
            return Respont;
        } else {

            Respont = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g, '$1,').split('').reverse().join('').replace(/^[\,]/, '')
            return Respont;

        };
    }
    else {
        //alert('You may enter only numbers in this field!');
        //  Amont.value = input.value.substring(0, input.value.length - 1);
        return Respont;
    }
}



</script>
