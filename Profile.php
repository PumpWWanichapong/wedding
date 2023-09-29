<?php include 'Header.php'; 

$UID = $_SESSION['AccountID'] ;
$sqlAccount = "SELECT `AccountID`, `Prefix`, `Name`, `LastName`, `Address`, `PhoneNo`, `Email`, `AccountType`, `Password` FROM `account` WHERE AccountID = $UID";
$ConAccount = $conn->query($sqlAccount);
$Account = $ConAccount->fetch_assoc();
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <br>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">ข้อมูลสมาชิก</h6>
            </div>
            <div class="card-body">
                <form class="user" action="Controller/Profile.php" method="post">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control form-control-user" name="Fname" value="<?php echo $Account["Name"]?>"
                                placeholder="First Name">
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control form-control-user" name="Lname" value="<?php echo $Account["LastName"]?>"
                                placeholder="Last Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control form-control-user" disabled  name="Email" value="<?php echo $Account["Email"]?>"
                            placeholder="Email Address">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control form-control-user" name="PhoneNo" value="<?php echo $Account["PhoneNo"]?>"
                            placeholder="Phone Number">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="Address" value="<?php echo $Account["Address"]?>"
                            placeholder="Address">
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-3">
                            <input type="submit" class="btn btn-primary btn-user btn-block" name="Update" value="บันทึก">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <input type="password" class="form-control form-control-user" name="Password" 
                                    placeholder="Password">
                        </div>
                        <div class="col-sm-6">
                            <input type="password" class="form-control form-control-user" name="NewPassword"
                                    placeholder="Repeat Password">
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-3">
                            <input type="submit" class="btn btn-primary btn-user btn-block" name="ResetPassword" value="เปลี่ยนรหัสผ่าน">
                        </div>
                    </div>
                </form>
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
