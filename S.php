<?php include 'Header.php'; ?>

<div class="w3-content w3-section" style="width:100%; ">
  <img class="mySlides" src="https://www.w3bai.com/w3css/img_la.jpg" style="width:100%; height: 300px;">
  <img class="mySlides" src="https://www.w3bai.com/w3css/img_ny.jpg" style="width:100%; height: 300px;">
  <img class="mySlides" src="https://www.w3bai.com/w3css/img_la.jpg" style="width:100%; height: 300px; ">
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
    setTimeout(carousel, 2000); // Change image every 2 seconds
}
</script>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->
    <div  class="row">

     <?php for ($i=0; $i < 2 ; $i++) { ?>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-3" style="padding-top: 10px">
          <a href="Produc.php">
            <div class="card border-left shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-12">
                        <img style="width:200px;" src="img/line_33846880930691197844396.jpeg" class="rounded mx-auto d-block" alt="...">
                        </div>
                        <div class="color-12">
                              <label> ชุดเจ้าสาว</label>
                        </div>
                        <div class="col-12">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
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
