<?php include 'Header_Admin.php';
      include 'DBcontext.php';

      if (isset($_GET['ID'])) {
        $ID = $_GET['ID'];
        $sql = "SELECT * FROM Account WHERE AccountID = $ID "; // Replace with your actual table and column names
        $result = $conn->query($sql);
        $Data = $result->fetch_assoc();
      }

      if(isset($_POST['Submit'])){
        $Name = $_POST['Name'];
        $LastName = $_POST['LastName'];
        $Email = $_POST['Email'];
        $PhoneNo = $_POST['PhoneNo'];
        $Address = $_POST['Address'];
        $AccountID = $_POST['AccountID'];
        $AccountType = $_POST['AccountType'];
        $Password = $_POST['Password'];
        $Prefix = $_POST['Prefix'];

        $SqlUpdate = "UPDATE Account SET Prefix = '$Prefix ',
        Name = '$Name',
        LastName = '$LastName',
        Address = '$Address',
        PhoneNo = '$PhoneNo',
        Email = '$Email',
        AccountType = '$AccountType',
        Password = '$Password' WHERE AccountID = $AccountID";

        if ($conn->query($SqlUpdate) === TRUE) {
            echo "<script>alert('ทำรายการสำเร็จ!')</script>";
            echo "<script>window.location.href='Account.php'</script>";
        } else {
           // echo "<script>alert('" . $conn->error . "')</script>";
            echo $conn->error ;
        }

      }

      if(isset($_POST['Back'])){
        echo "<script>window.location.href='Account.php'</script>";
      }

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
                <form method="post">
                    <div class="row">
                        <input type="text" name="AccountID" value="<?php  echo $ID ?>" hidden>
                        <div class="col-md-2">
                            <label  class="form-label">คำนำหน้า</label>
                            <select name="Prefix" class="form-control"  >
                                <option value="นาย"  <?php if($Data["Prefix"] == 'นาย'){ echo "selected";} ?> >นาย</option>
                                <option value="นาง" <?php if($Data["Prefix"] == 'นาง'){ echo "selected";} ?>>นาง</option>
                                <option value="นางสาว" <?php if($Data["Prefix"] == 'นางสาว'){ echo "selected";} ?>>นางสาว</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label for="inputEmail4" class="form-label">ชื่อ</label>
                            <input type="text" name="Name" class="form-control"  value="<?php  echo $Data["Name"] ?>" >
                        </div>
                        <div class="col-md-5">
                            <label for="inputEmail4" class="form-label">นามสกุล</label>
                            <input type="text" class="form-control" name="LastName"  value="<?php echo $Data["LastName"] ?>"  >
                        </div>
                        <div class="col-6" style="padding-top: 10px;">
                            <label for="inputAddress" class="form-label">Email</label>
                            <input type="email" class="form-control"  name="Email" value="<?php echo $Data["Email"]?>">
                        </div>
                        <div class="col-6" style="padding-top: 10px;">
                            <label for="inputAddress" class="form-label">เบอร์โทร</label>
                            <input type="text" class="form-control" name="PhoneNo" value="<?php echo $Data["PhoneNo"]?>"  >
                        </div>
                        <div class="col-12" style="padding-top: 10px;">
                            <label for="inputEmail4" class="form-label">ที่อยู่</label>
                            <input type="text" class="form-control" name="Address" value="<?php echo $Data["Address"]?>" >
                        </div>
                        <div class="col-6" style="padding-top: 10px;">
                         <label  class="form-label">Type</label>
                            <select class="form-control" name="AccountType" >
                              <option value="User"  <?php if($Data["AccountType"] == 'User'){  echo "selected"; } ?>  >User</option>
                              <option value="Admin" <?php if($Data["AccountType"] == 'Admin'){ echo "selected"; } ?> >Admin</option>
                            </select>
                        </div>
                        <div class="col-6" style="padding-top: 10px;">
                            <label  class="form-label">Password</label>
                            <input type="password" class="form-control" name="Password" value="<?php echo $Data["Password"]; ?>" >
                        </div>
                    </div>
                    <br>
                    <div class="row justify-content-md-center" >
                        <div class="col-2">
                            <input class="btn btn-success btn-user btn-block" type="submit" id="Submit" name="Submit" value="บันทึก" >
                        </div>
                        <div class="col-2">
                            <button class="btn btn-danger btn-user btn-block" name="Back" >ยกเลิก</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
    <!-- /.container-fluid -->

    <script>



    </script>


<?php include 'Foodter.php'; ?>
