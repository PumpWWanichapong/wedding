<?php
  include "../DBcontext.php";
  session_start();

  if(isset($_SESSION['AccountID']))
  {
    if(isset($_POST["Type"]))
    {
      $CartType = $_POST["Type"];

      if($CartType == 'Delete')
      {
        $ODID = $_POST["ODID"];
        $sqlDelete = "DELETE FROM `orderdetail` WHERE ODID = $ODID";
        $conn->query($sqlDelete);
      }

      if($CartType == 'Submit')
      {
        $jsonData = $_POST["jsonData"];
        $arr = json_decode($jsonData, true);

        foreach($arr as $item) { //foreach element in $arr

          $Amount = $item['Amount'];
          $ODID = $item['ODID'];
          $Price = $item['SunAmount'];

          $sqlUpdate = "UPDATE `orderdetail` SET `Amount`=  $Amount,`Price`= $Price WHERE ODID = $ODID"; 
          $conn->query($sqlUpdate);

        }

        $OID = $_POST["OID"];
        $OrderPrice = $_POST["OrderPrice"];
        $OrderAmount = $_POST["OrderAmount"];

        $SqlUpdateOrder = "UPDATE `order` SET OrderPrice = $OrderPrice , OrderAmount = $OrderAmount , CreateDate = NOW() WHERE OID = $OID";
        $conn->query($SqlUpdateOrder);

      }
    }
  }
?>