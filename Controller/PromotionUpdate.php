<?php
include "../DBcontext.php";

$PromotionID = $_POST['PromotionID'];
$PromotionStartDate = $_POST['PromotionStartDate'];
$PromotionEndDate = $_POST['PromotionEndDate'];
$PromotionName = $_POST['PromotionName'];
$PromotionDetail = $_POST['PromotionDetail'];

$targetDir = "../Photo/";  // Directory to store uploaded files
$uploadedFile = $_FILES["file"]["tmp_name"];
$originalFileName = basename($_FILES["file"]["name"]);

if(isset($_POST['submit'])){

    if($uploadedFile != null){

        // Generate a new unique filename
        $newFileName = uniqid() . "_" . $originalFileName;
        $targetFile = $targetDir . $newFileName;
    
        // Upload the file
        if (move_uploaded_file($uploadedFile, $targetFile)) {
            
            $sql = "UPDATE promotion SET PromotionName='$PromotionName',PromotionDetail='$PromotionDetail',
            PromotionStartDate='$PromotionStartDate',PromotionEndDate='$PromotionEndDate',PromotionFile='$newFileName' WHERE PromotionID = $PromotionID";
    
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('successfully')</script>";
                echo "<script>window.location.href='../Promotion.php'</script>";
            } else {
            // echo "<script>alert('" . $conn->error . "')</script>";
                echo $conn->error ;
                echo "<script>alert('"+ $conn->error +"')</script>";
                echo "<script>window.location.href='../Promotion.php'</script>";
            }
    
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
            echo "<script>window.location.href='../Promotion.php'</script>";
        }

    }else {

        $sql = "UPDATE promotion SET PromotionName='$PromotionName',PromotionDetail='$PromotionDetail',
        PromotionStartDate='$PromotionStartDate',PromotionEndDate='$PromotionEndDate' WHERE PromotionID = $PromotionID";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('ทำรายการสำเร็จ')</script>";
            echo "<script>window.location.href='../Promotion.php'</script>";
        } else {
        // echo "<script>alert('" . $conn->error . "')</script>";
            echo $conn->error ;
            echo "<script>alert('"+ $conn->error +"')</script>";
            echo "<script>window.location.href='../Promotion.php'</script>";
        }

    }
}

if(isset($_POST['Delete'])){
    $sql = "DELETE FROM promotion WHERE PromotionID = $PromotionID";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('successfully')</script>";
        echo "<script>window.location.href='../Promotion.php'</script>";
    } else {
    // echo "<script>alert('" . $conn->error . "')</script>";
        echo $conn->error ;
        echo "<script>alert('"+ $conn->error +"')</script>";
        echo "<script>window.location.href='../Promotion.php'</script>";
    }
}

if(isset($_POST['Clost'])){
    echo "<script>window.location.href='../Promotion.php'</script>";
}




?>