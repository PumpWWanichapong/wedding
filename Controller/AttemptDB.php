<?php
include "../DBcontext.php";

  $AccountID = $_POST['AccountID'];
  $AttemptDate = $_POST['AttemptDate'];
  $AttemptTemp = $_POST['AttemptTemp'];

  if(isset($_POST['Insert'])){

    $sql = "INSERT INTO `attempt`( `AccountID`, `AttemptDate`, `AttemptTemp`) VALUES
            ('$AccountID','$AttemptDate','$AttemptTemp')";

    $jsonData = $_POST['Json'];
    $arr = json_decode($jsonData, true);

    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;

        foreach($arr as $item) { //foreach element in $arr
            $PID = $item['PID'];
            $Amount = $item['Amount'];

            $sqlfile = "INSERT INTO `attemptdetail`(`AID`, `PID`, `Amount`) VALUES ('$last_id','$PID','$Amount')";
            $conn->query($sqlfile);
        }

        echo "<script>alert('ทำรายการสำเร็จ!')</script>";
        echo "<script>window.location.href='../Attempt.php'</script>";
    } else {
         echo "<script>alert('"+$conn->error+"')</script>";
         echo "<script>window.location.href='../History.php'</script>";
    }

  };


  if(isset($_POST['Delete'])){

  };

  if(isset($_POST['Update'])){

    $AID = $_POST['AID'];
    $sqlUpdate = "UPDATE `attempt` SET `AccountID`='$AccountID',`AttemptDate`='$AttemptDate',`AttemptTemp`='$AttemptTemp' WHERE AID = $AID ";

    $jsonData = $_POST['Json'];
    $arr = json_decode($jsonData, true);

    if ($conn->query($sqlUpdate) === TRUE) {

       $sqldelete = "DELETE FROM `attemptdetail` WHERE AID = $AID";
       $conn->query($sqldelete);

        foreach($arr as $item) { //foreach element in $arr
            $PID = $item['PID'];
            $Amount = $item['Amount'];

            $sqlfile = "INSERT INTO `attemptdetail`(`AID`, `PID`, `Amount`) VALUES ('$AID','$PID','$Amount')";
            $conn->query($sqlfile);
        }

        echo "<script>alert('ทำรายการสำเร็จ!')</script>";
        echo "<script>window.location.href='../Attempt.php'</script>";
    } else {
         echo "<script>alert('"+$conn->error+"')</script>";
         echo "<script>window.location.href='../History.php'</script>";
    }

  };

?>
