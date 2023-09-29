<?php include 'Header.php'; 
?>

<div class="w3-content w3-section" style="width:100%; ">
  <!-- <a href="News.php"><img class="mySlides" src="https://www.w3bai.com/w3css/img_la.jpg" style="width:100%; height: 300px;">  </a>
  <a href="News.php"><img class="mySlides" src="https://www.w3bai.com/w3css/img_ny.jpg" style="width:100%; height: 300px;">  </a>
  <a href="News.php"><img class="mySlides" src="https://www.w3bai.com/w3css/img_la.jpg" style="width:100%; height: 300px; "> </a> -->

  <?php 
     $sqlNew = "SELECT * FROM `promotion` ";
     $resultNew = $conn->query($sqlNew);
     while ($i = $resultNew->fetch_assoc()) {
  ?>

  <a href="News.php?ID=<?php echo $i["PromotionID"] ?>"><img class="mySlides" src="Photo\<?php echo $i["PromotionFile"]?>" style="width:100%; height: 300px;">  </a>
  <!-- <a href="News.php"><img class="mySlides" src="img\Promoion2.jpg" style="width:100%; height: 300px;">  </a> -->
  <?php }?>
</div>

<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}
    x[myIndex-1].style.display = "block";
    setTimeout(carousel, 5000); // Change image every 5 seconds
}
</script>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->
    <div  class="row">

     <?php 
     
     $sql = "SELECT (SELECT FileURL FROM fliedoc WHERE PID = product.PID LIMIT 1) as FileURL,`PID`, `ProductName`, `ProductDetail`, `Zise`, `ProductAmount`, `FID`, `ProductPrice`, `Discount`, `ProductType` FROM `product` 
     WHERE `product`.`PID` NOT in (SELECT `orderdetail`.`PID` FROM `order` INNER JOIN `orderdetail` on `order`.`OID` = `orderdetail`.`OID` WHERE `order`.`ReturnDate` is null AND `order`.`OrderType` = 'O');";

     $result = $conn->query($sql);
     while ($row = $result->fetch_assoc()) {
      ?>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-lg-3 col-sm-6" style="padding-top: 10px">
          <a href="Produc.php?ID=<?php echo $row["PID"] ?>">
            <div class="card border-left shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-12">
                        <img style="width:200px;" src="Photo/<?php echo $row["FileURL"]?>" class="rounded mx-auto d-block" >
                        </div><hr>
                        <div class="color-12">
                              <label> <?php echo $row["ProductName"]?></label>
                              </div>
                        <div class="col-12">
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $row["ProductPrice"]?> บาท/วัน</div>
                            <span class="text-gray-800" style='text-decoration:line-through'> <b> <?php if($row["Discount"] != "0.00") { echo $row["Discount"] ; } ?> </b> 
                        </div>

                    </div>
                </div>
            </div>
          </a>
        </div>

      <?php } ?>

    </div>

</div>
<!-- /.container-fluid -->

<?php include 'Foodter.php'; ?>
