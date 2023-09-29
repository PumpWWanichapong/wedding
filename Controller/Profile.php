<?php
include "../DBcontext.php";
session_start();

$UID = $_SESSION['AccountID'] ;

if(isset($_POST["Update"])){
  echo "Update";

  $Fname = $_POST["Fname"];
  $Lname = $_POST["Lname"];
  $PhoneNo = $_POST["PhoneNo"];
  $Address = $_POST["Address"];

  $UpdateAccount = "UPDATE account SET Name = '$Fname', LastName = '$Lname', PhoneNo = '$PhoneNo', Address = '$Address' WHERE AccountID = $UID";

  if ($conn->query($UpdateAccount) === TRUE) {
    echo "<script>alert('ทำรายการสำเร็จ!')</script>";
    echo "<script>window.location.href='../Profile.php'</script>";
  }

}


if(isset($_POST["ResetPassword"])){
  $Password = $_POST["Password"];
  $NewPassword = $_POST["NewPassword"];

  $SqlCheckPassword = "SELECT * FROM `account` WHERE AccountID = $UID";
  $PasswordDB = $conn->query($SqlCheckPassword);
  $rowDb = $PasswordDB->fetch_assoc();


  if($rowDb["Password"] != $Password){

    echo "<script>alert('รหัสผ่านไม่ถูกต้อง')</script>";
    echo "<script>window.location.href='../Profile.php'</script>";

  }else{

    $UpdatePassword = "UPDATE account set Password = '$NewPassword' WHERE AccountID = $UID";
    if ($conn->query($UpdatePassword) === TRUE) {
    echo "<script>alert('successfully')</script>";
    echo "<script>window.location.href='../Profile.php'</script>";
    }

  }

}


?>