<?php
include "../DBcontext.php";

$PID = $_POST['PID'];
$ProductName = $_POST['ProductName'];
$ProductType = $_POST['ProductType'];
$ProductDetail = $_POST['ProductDetail'];
$ProductAmount = $_POST['ProductAmount'];
$Discount = $_POST['Discount'];
$ProductPrice = $_POST['ProductPrice'];
$Zise = $_POST['Zise'];
$Color = $_POST['Color'];
$jsonData = $_POST['Json'];

if(isset($_POST['Edit'])){

    $arr = json_decode($jsonData, true);

    $sql_file = "SELECT * FROM `fliedoc` WHERE PID = $PID";
    $Filedoc = $conn->query($sql_file);

    $Sql = "UPDATE product SET ProductName='$ProductName',ProductDetail='$ProductDetail',Zise='$Zise',Color='$Color',
            ProductAmount='$ProductAmount',ProductPrice='$ProductPrice',Discount='$Discount',
            ProductType='$ProductType' WHERE PID = $PID ";

    if ($conn->query($Sql) === TRUE) {

        foreach($arr as $item) { //foreach element in $arr
            if($item['FID'] == 0 && $item['File64'] != null){
                $File64 = $item['File64'];
                $FileNameDisplay = $item['FileName'];
                $uploadpath   = '../Photo/';
                $parts        = explode(";base64,", $File64);
                $imageparts   = explode("image/", @$parts[0]);
                $imagetype    = $imageparts[1];
                $imagebase64  = base64_decode($parts[1]);
                $filename     = uniqid() . '.' . $imagetype;
                $file         = $uploadpath . $filename;
                $sqlfile = "INSERT INTO fliedoc( PID, FlieName, FileURL) VALUES ('$PID','$FileNameDisplay','$filename')";
                $conn->query($sqlfile);
                file_put_contents($file, $imagebase64);
            }
        }

        while ($row = $Filedoc->fetch_assoc()) {
            
            $s = false; 
            $FID = $row["FID"];

            foreach($arr as $i){
                if($FID == $i["FID"]){
                    $s = true; 
                }
            }

            if(!$s){
               $SqlDelete = "DELETE FROM `fliedoc` WHERE FID = $FID";
               $conn->query($SqlDelete);
            }

        }

        echo "<script>alert('ทำรายการสำเร็จ!')</script>";
        echo "<script>window.location.href='../HomeAdmin.php'</script>";
    } else {
        echo "<script>alert('"+ $conn->error +"')</script>";
        echo "<script>window.location.href='../HomeAdmin.php'</script>";
    }

}


if(isset($_POST['Delete'])){

   $sqlDelete = "DELETE FROM product WHERE PID = $PID";
   $conn->query($sqlDelete);

   $sqlDeletefile = "DELETE FROM fliedoc WHERE PID = $PID";
   $conn->query($sqlDeletefile);

   echo "<script>alert('ทำรายการสำเร็จ')</script>";
   echo "<script>window.location.href='../HomeAdmin.php'</script>";
}


?>
