<?php include 'Header.php'; 

if(isset($_GET["ID"])){

    $PromotionID = $_GET["ID"];
    $sqlPromotion = "SELECT `PromotionID`, `PromotionName`, `PromotionDetail`, `PromotionStartDate`, `PromotionEndDate`, `PromotionFile` 
    FROM `promotion` WHERE PromotionID = $PromotionID";
     $result = $conn->query($sqlPromotion);
     $Promotion = $result->fetch_assoc();

}

?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <br>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">โปรโมชั้น</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                  <img class="mySlides" src="Photo/<?php echo $Promotion["PromotionFile"] ?>" style="width:100%; height: 300px;">
                                </div>
                                <br>
                                <div class="col-12">
                                    <br>
                                    <h4><b> <?php echo $Promotion["PromotionName"] ?> </b></h4>
                                    <br>
                                    <label>
                                     <?php echo $Promotion["PromotionDetail"] ?>
                                    </label>
                                    <br>
                                    <label> <?php echo $Promotion["PromotionStartDate"] ?> - <?php echo $Promotion["PromotionEndDate"] ?></label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->


    <script>

     let table = new DataTable('#TbProduct');

    function Product(){
            window.location.assign("HistoryAttemptDetail.php")
    }

    </script>

<?php include 'Foodter.php'; ?>
