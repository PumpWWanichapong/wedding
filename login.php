<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<?php 

 include 'DBcontext.php';

 session_start();
 if (isset($_POST['Login'])) {
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];

    $sql = "SELECT * FROM `account` WHERE Email = '$Username' AND Password = '$Password'";

    $result = $conn->query($sql);
    $num = mysqli_fetch_array($result);


    if ($num > 0) {
      $_SESSION['AccountID'] = $num['AccountID'];
      $_SESSION['Name'] = $num['Name'];
      $_SESSION['LastName'] = $num['LastName'];
      $_SESSION['UserRow'] = $num['AccountType'];
      $id = $num['AccountID'];

      echo $id;

       if ($_SESSION['UserRow'] == 'User') {
         echo "<script>window.location.href='Home.php'</script>";
       }else {
      //.   echo "<script>alert('เข้าสู่ระบบไม่สำเร็จ กรุณาเข้าสู่ระบบอีกครั้ง!!')</script>";
         echo "<script>window.location.href='HomeAdmin.php'</script>";
       }

    }
    else {

       echo "<script>alert('เข้าสู่ระบบไม่สำเร็จ กรุณาเข้าสู่ระบบอีกครั้ง!!')</script>";
       echo "<script>window.location.href='login.php'</script>";
   }

 };
?>

<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row text-center">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">เข้าสู่ระบบเช่าชุดวิวาห์ออนไลน์</h1>
                                    </div>
                                    <form class="user" action="#" method="post">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp" name="Username"
                                                placeholder="กรุณากรอกอีเมล">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="Password"
                                                id="exampleInputPassword" placeholder="กรุณากรอกรหัสผ่าน"> 
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" name="Login" value="เข้าสู่ระบบ">
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="btn btn-secondary btn-user btn-block" href="Register.php">สมัครสมาชิก</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>