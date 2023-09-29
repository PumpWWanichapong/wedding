<?php include 'Header.php';

  if(isset($_GET["ID"])){
    $PID = $_GET["ID"];
    $ProductFile = "SELECT * FROM `fliedoc` WHERE PID = $PID";
    $result = $conn->query($ProductFile);
    
  }else {
    echo "<script>window.location.href='Home.php'</script>";
  }

?>

<div class="card">

  <div class="row">
    <div class="col-6">
      <div class="w3-content" style="max-width:1200px">
        <?php 
          while ($i = $result->fetch_assoc()) {
        ?>
        <img class="mySlides" src="Photo/<?php echo $i["FileURL"]?>" style="width:50%; height: 400px">
        <?php }?>
          <hr>
        <div class="col-12" style="padding-top:10px">
          <div class="row">
            <?php 
                $File = "SELECT * FROM `fliedoc` WHERE PID = $PID";
                $resultFile = $conn->query($File);
                $CountFile = 0;
              while ($data = $resultFile->fetch_assoc()) {
                $CountFile++;
            ?>
            <div class="col-3">
              <img src="Photo/<?php echo $data["FileURL"]?>" style="width:100%" onclick="currentDiv(<?php echo $CountFile ?>)">
            </div>
            <?php   }?>
          </div>
        </div>
      </div>
    </div>

    <?php 
      $ProductDetail = "SELECT `PID`, `ProductName`, `ProductDetail`, `Zise`,`Color`, `ProductAmount`, `FID`, `ProductPrice`, `Discount`, `ProductType` FROM `product` WHERE PID = $PID";
      $Detail = $conn->query($ProductDetail);
      $DataDetail = $Detail->fetch_assoc();
    ?>

    <div class="col-6">
    <h2><?php echo $DataDetail["ProductName"] ?> </h2>
    

    <label style="padding: 20px 10px 20px 0px;"><b>รายละเอียด: <hr><?php echo $DataDetail["ProductDetail"] ?></b><span>
              <h5>ประเภทชุด :<?php echo $DataDetail["ProductType"] ?> </h5>
<h5>ไซค์ :<?php echo $DataDetail["Zise"] ?></h5>
        <h5>สี :<?php echo $DataDetail["Color"] ?> </h5>
      </label>
     <hr>
      <h2><?php echo $DataDetail["ProductPrice"] ?> บาท/วัน </h2>
      <span style='text-decoration:line-through'> <b> <?php if($DataDetail["Discount"] != "0.00") { echo $DataDetail["Discount"] ; } ?> </b> 
     </span>
      <hr>
      <div class="row">
        <a href="RentalFrom.php?ProductID=<?php echo $PID?>&ProductType=Buy" class="btn btn-success btn-icon-split" >
            <span class="icon text-white-50">
                <i class="fas fa-check"></i>
            </span>
            <span class="text">เช่าเลย</span>
        </a>
        &nbsp;&nbsp;&nbsp;
        <a href="Controller/CartDB.php?ProductID=<?php echo $PID?>&ProductType=Add" class="btn btn-success btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-check"></i>
            </span>
            <span class="text">เพิ่มลงในตะกร้า</span>
        </a>
      </div>
    </div>
  </div>

</div>


<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length} ;
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
     dots[i].className = dots[i].className.replace(" w3-border-red", "");
  }
  x[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " w3-border-red";
}
</script>


<?php include 'Foodter.php'; ?>
