<?php
include "../DBcontext.php";

  $AccountID = $_POST['AccountID'];
  $StartDate = $_POST['StartDate'];
  $EndDate = $_POST['EndDate'];
  $ReturnDate = $_POST['ReturnDate'];
  $OrderPrice = $_POST['OrderPrice'];

if(isset($_POST['Insert'])){

  $Sql = "INSERT INTO `order`( AccountID, OrderPrice, OrderAmount, CreateBy, CreateDate, StartDate, EndDate, ReturnDate)
           VALUES ('$AccountID','$OrderPrice',null,null,null,'$StartDate','$EndDate','$ReturnDate')";

    $jsonData = $_POST['Json'];
    $arr = json_decode($jsonData, true);

    if ($conn->query($Sql) === TRUE) {
        $last_id = $conn->insert_id;

        foreach($arr as $item) { //foreach element in $arr

            $PID = $item['PID'];
            $Amount = $item['Amount'];
            $Price = $item['Price'];
            $sqlfile = "INSERT INTO orderdetail( OID, PID, Amount, Price) VALUES ('$last_id','$PID','$Amount','$Price')";
            $conn->query($sqlfile);
        }

        echo "<script>alert('ทำรายการสำเร็จ!')</script>";
        echo "<script>window.location.href='../History.php'</script>";
    } else {
         echo "<script>alert('"+$conn->error+"')</script>";
         echo "<script>window.location.href='../History.php'</script>";
    }

}

if(isset($_POST['Update'])){


  $OID = $_POST['OID'];
  $Sql = "UPDATE `order` SET `AccountID`='$AccountID',`OrderPrice`='$OrderPrice',
           `StartDate`='$StartDate',`EndDate`='$EndDate',`ReturnDate`='$ReturnDate' WHERE `OID` = $OID";

  $conn->query($Sql);

   echo "<script>alert('ทำรายการสำเร็จ!')</script>";
   echo "<script>window.location.href='../History.php'</script>";

    //  $jsonData = $_POST['Json'];
    //  $arr = json_decode($jsonData, true);

      // if ($conn->query($Sql) === TRUE) {
      //     $last_id = $conn->insert_id;
      //
      //     foreach($arr as $item) { //foreach element in $arr
      //
      //         $PID = $item['PID'];
      //         $Amount = $item['Amount'];
      //         $Price = $item['Price'];
      //         $sqlfile = "INSERT INTO orderdetail( OID, PID, Amount, Price) VALUES ('$last_id','$PID','$Amount','$Price')";
      //         $conn->query($sqlfile);
      //     }
      //
      //     echo "<script>alert('ทำรายการสำเร็จ!')</script>";
      //     echo "<script>window.location.href='../History.php'</script>";
      // } else {
      //     // echo "<script>alert('"+$conn->error+"')</script>";
      //     // echo "<script>window.location.href='../History.php'</script>";
      //
      //     echo $conn->error;
      // }

}


?>
