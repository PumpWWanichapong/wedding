<?php
    include "../DBcontext.php";
    session_start();
    if(isset($_SESSION['AccountID'])){

        $AccountID = $_SESSION['AccountID'];
        $sqlCart = "SELECT * FROM `order` WHERE AccountID = $AccountID AND OrderType = 'C'";
        $QCart = $conn->query($sqlCart);
        $DataCart = $QCart->fetch_assoc();
        $OID = $DataCart["OID"];

        $StartDate = $_POST["StartDate"];
        $EndDate = $_POST["EndDate"];

        $AttemptDate = $_POST["AttemptDate"];
        $AttemptTemp = $_POST["AttemptTemp"];

        }

        $sqlUpdateOrder = "UPDATE `order` SET `StartDate` = '$StartDate' , `EndDate` = '$EndDate' ,  OrderType = 'O' ,Bill = '$newFileName' WHERE `OID` = $OID";
        $conn->query($sqlUpdateOrder);

        if($AttemptDate != null){
            $sqlInsertAttempt = "INSERT INTO `attempt`(`AccountID`, `AttemptDate`, `AttemptTemp`) VALUES ($AccountID,'$AttemptDate','$AttemptTemp')";
            if ($conn->query($sqlInsertAttempt) === TRUE) {
                $last_id = $conn->insert_id;
    
                $sqlOrder = "SELECT * FROM `orderdetail` WHERE OID = $OID";
                $QOrder = $conn->query($sqlOrder);
    
                while ($i = $QOrder->fetch_assoc()) {
                    
                    $PID = $i["PID"];
                    $Amount = $i["Amount"];
    
                    $sqlInsert = "INSERT INTO `attemptdetail`(`AID`, `PID`, `Amount`) VALUES ($last_id,$PID,$Amount)";
                    $conn->query($sqlInsert);
    
                }
    
            }
        }

        echo "<script>alert('ทำรายการสำเร็จ!')</script>";
        echo "<script>window.location.href='../Home.php'</script>";
        
    

?>