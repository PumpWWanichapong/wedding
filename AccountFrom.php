<?php include 'Header_Admin.php';
      include 'DBcontext.php';

      if(isset($_POST['Submit'])){
        $Name = $_POST['Name'];
        $LastName = $_POST['LastName'];
        $Email = $_POST['Email'];
        $PhoneNo = $_POST['PhoneNo'];
        $Address = $_POST['Address'];
        $AccountID = $_POST['AccountID'];
        $Password = $_POST['Password'];
        $Prefix = $_POST['Password'];
        $AccountType = $_POST['AccountType'];

        $sqlinsert = "INSERT INTO account( Prefix, Name, LastName, Address, PhoneNo, Email, AccountType, Password) 
                      VALUES ('$Prefix','$Name','$LastName','$Address','$PhoneNo','$Email','$AccountType','$Password')";

        if ($conn->query($sqlinsert) === TRUE) {
            echo "<script>alert('ทำรายการสำเร็จ!')</script>";
            echo "<script>window.location.href='Account.php'</script>";
        } else {
            echo "<script>alert('"+ $conn->error +"')</script>";
            echo "<script>window.location.href='Account.php'</script>";
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
                        <div class="col-md-2">
                            <label  class="form-label">คำนำหน้า</label>
                            <select name="Prefix" class="form-control">
                                <option value="นาย">นาย</option>
                                <option value="นาง">นาง</option>
                                <option value="นางสาว">นางสาว</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label  class="form-label">ชื่อ</label>
                            <input type="text" name="Name" class="form-control"  >
                        </div>
                        <div class="col-md-5">
                            <label  class="form-label">นามสกุล</label>
                            <input type="text" class="form-control" name="LastName" >
                        </div>
                        <div class="col-6" style="padding-top: 10px;">
                            <label  class="form-label">Email</label>
                            <input type="text" class="form-control"  name="Email" >
                        </div>
                        <div class="col-6" style="padding-top: 10px;">
                            <label  class="form-label">เบอร์โทร</label>
                            <input type="text" class="form-control" name="PhoneNo"  >
                        </div>
                        <div class="col-12" style="padding-top: 10px;">
                            <label  class="form-label">ที่อยู่</label>
                            <input type="text" class="form-control" name="Address"  >
                        </div>
                        <div class="col-6" style="padding-top: 10px;">
                         <label  class="form-label">Type</label>
                            <select class="form-control" name="AccountType">
                              <option value="User">User</option>
                              <option value="Addmin">Addmin</option>
                            </select>
                        </div>
                        <div class="col-6" style="padding-top: 10px;">
                            <label  class="form-label">Password</label>
                            <input type="Password" class="form-control" name="Password"  >
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
