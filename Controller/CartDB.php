<?php
include "../DBcontext.php";
session_start();

if(isset($_SESSION['AccountID'])){

    $ProductID = $_GET["ProductID"];
    $ProductType =  $_GET["ProductType"];
    $AccountID = $_SESSION['AccountID'];
    $IsCheckOrderByCart = false;

    $sqlCheckCart = "SELECT * FROM `order`  INNER JOIN orderdetail  on  `order`.`OID` = orderdetail.OID WHERE `order`.`AccountID` = '$AccountID' AND `order`.`OrderType` = 'C'";
    $QCheckCart = $conn->query($sqlCheckCart);
    $DataCheckCart = $QCheckCart->fetch_assoc();

    $OID = $DataCheckCart["OID"];

    if($OID != null){
        $IsCheckOrder = 0;
        $sqlOrderDetail = "SELECT * FROM `orderdetail` WHERE OID = $OID";
        $QOrderDetail = $conn->query($sqlOrderDetail);

        while ($row = $QOrderDetail->fetch_assoc()) { 
            $PID = $row["PID"];
            if($PID == $ProductID){
                $IsCheckOrder = $IsCheckOrder + 1;
            }
        }

        if($IsCheckOrder != 0){
            $IsCheckOrderByCart = true;
        }

    }

    if($IsCheckOrderByCart){
        if($ProductType == "Add"){        
            echo "<script>alert('มีรายการสินค้านี้ในตะกร้าแล้ว')</script>";
            echo "<script>window.location.href='../Produc.php?ID=$ProductID'</script>";
        }else {
            echo "<script>window.location.href='../Cart.php'</script>";
        }
    }else{
        if($DataCheckCart != null){
            $sqlInserOrderDetail = "INSERT INTO `orderdetail`(`OID`, `PID`, `Amount`) VALUES ($OID,$ProductID,1)";
            $conn->query($sqlInserOrderDetail);
        }else{
            $sqlInserOrderCart = "INSERT INTO `order`(`AccountID`, `OrderType`) VALUES ($AccountID,'C')";
            if ($conn->query($sqlInserOrderCart) === TRUE) {
                $last_id = $conn->insert_id;
                 $InserOrderDetail = "INSERT INTO `orderdetail`(`OID`, `PID`, `Amount`) VALUES ($last_id,$ProductID,1)";
                 $conn->query($InserOrderDetail);
            }        
        }

        if($ProductType == "Add"){                    
            echo "<script>window.location.href='../Produc.php?ID=$ProductID'</script>";
        }else {
            echo "<script>window.location.href='../Cart.php'</script>";
        }
    }

    if($ProductType == "Add"){        
        echo "<script>window.location.href='../Produc.php?ID=$ProductID'</script>";
    }else {
        echo "<script>window.location.href='../Cart.php'</script>";
    }


}else{
    echo "<script>window.location.href='../Login.php'</script>";
}




?>