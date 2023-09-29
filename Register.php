<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<?php 

if(isset($_POST['Regester'])){
    include "DBcontext.php";

    $Email = $_POST['Email'];
    $username = $_POST['Fname'];
    $lastname = $_POST['Lname'];
    $password = $_POST['Password'];
    $address = $_POST['Address'];
    $phonenumber = $_POST['PhoneNo'];

    $sqlCheck = "SELECT * FROM account WHERE Email = '$Email'";
    $result = $conn->query($sqlCheck);
    $Data = $result->fetch_assoc();

    $ID = $Data['AccountID'];

    if($ID != null){
        echo "<script>alert('Email นี้มีผู้ใช่งานแล้ว !')</script>";
    }else{

        $sqlInsert = "INSERT INTO `account`(`Name`, `LastName`, `Address`, `PhoneNo`, `Email`, `AccountType`, `Password`) 
        VALUES ('$username','$lastname','$address','$phonenumber','$Email','User','$password') ";

        if($conn->query($sqlInsert) === TRUE){
            echo "<script>alert('successfully')</script>";
            echo "<script>window.location.href='Login.php'</script>";
        }else{
            echo "<script>alert('"+$conn->error+"')</script>";
            echo "<script>window.location.href='Regester.php'</script>";
        }

    }
}
?>

<body class="bg-gradient-primary">
    <div class="container">
        <form action="" method="post">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">สมัครสมาชิก</h1>
                                </div>
                                <form class="user" action="" method="post">
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control form-control-user" placeholder="ชื่อจริง" name="Fname">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-user" placeholder="นามสกุล" name="Lname">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" placeholder="อีเมล" name="Email">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" class="form-control form-control-user"placeholder="รหัสผ่าน" name="Password">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control form-control-user" placeholder="ยืนยันรหัสผ่าน">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control form-control-user" placeholder="เบอร์โทรศัพท์" name="PhoneNo">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" placeholder="ที่อยู่" name="Address">
                                    </div>
                                    <div hidden>
                                    <input type="submit" name="Regester" id="OnSubmit" class="btn btn-primary btn-user btn-block" value="สมัครสมาชิก">
                                    </div>
                                </form>
                                <div class="row justify-content-center">
                                    <div class="row col-8">
                                        <div class="col-6">
                                            <input type="submit" name="Regester"  onclick="Submit()" class="btn btn-primary btn-user btn-block" value="สมัครสมาชิก">
                                        </div>
                                        <div class="col-6">
                                            <button onclick="Close()" class="btn btn-primary btn-user btn-block">
                                                ยกเลิก
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>

        function Submit(){
            $("#OnSubmit").click();
        }

        function Veridate(){

        }

        function Close(){
            window.location.href = 'Login.php';
        }

    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>