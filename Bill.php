<?php include 'Header.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <br>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Qr Code</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                   <div class="row justify-content-md-center">
                                     <img style="width:400px;" src="img/qrcode.png" class="rounded mx-auto d-block" alt="...">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label >วันที่เริ่มเช่า</label>
                                                <input type="Date" class="form-control form-control-user" >
                                            </div>
                                            <div class="col-sm-6">
                                                <label >ถึง</label>
                                                <input type="Date" class="form-control form-control-user"  >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label >วันที่ลองชุด</label>
                                                <input type="Date" class="form-control form-control-user" >
                                            </div>
                                            <div class="col-sm-6">
                                                <label >เวลา</label>
                                                <input type="Time" class="form-control form-control-user"  >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label >สลิปการโอนเงิน</label>
                                            <input type="file" class="form-control" >
                                        </div>
                                        <!-- <br>
                                        <div class="row justify-content-md-center">
                                            <button class="col-3 btn btn-primary btn-user btn-block">
                                              บันทึกใบเสร็จ
                                            </button>
                                        </div> -->
                                    </div>
                                    <br>
                                    <hr>
                                    <br>
                                    <div class="row justify-content-md-center">
                                        <div class="col-3">
                                            <a href="Home.php" class="btn btn-primary btn-user btn-block">
                                            ชำระเสร็จสิ้น
                                            </a>
                                        </div>
                                    </div>
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
