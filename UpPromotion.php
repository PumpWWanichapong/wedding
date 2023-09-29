<?php
    include 'DBcontext.php';

    $PromotionStartDate = $_POST['PromotionStartDate'];
    $PromotionEndDate = $_POST['PromotionEndDate'];
    $PromotionName = $_POST['PromotionName'];
    $PromotionDetail = $_POST['PromotionDetail'];

    $targetDir = "Photo/";  // Directory to store uploaded files
    $uploadedFile = $_FILES["file"]["tmp_name"];
    $originalFileName = basename($_FILES["file"]["name"]);
    
    // Generate a new unique filename
    $newFileName = uniqid() . "_" . $originalFileName;
    $targetFile = $targetDir . $newFileName;

    // Upload the file
    if (move_uploaded_file($uploadedFile, $targetFile)) {
        echo "The file " . $originalFileName . " has been uploaded as " . $newFileName;
        
        $sql = "INSERT INTO promotion( PromotionName, PromotionDetail, PromotionStartDate, PromotionEndDate, PromotionFile) 
        VALUES ('$PromotionName','$PromotionDetail','$PromotionStartDate','$PromotionEndDate','$newFileName')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('successfully')</script>";
            echo "<script>window.location.href='Promotion.php'</script>";
        } else {
        // echo "<script>alert('" . $conn->error . "')</script>";
            echo $conn->error ;
        }

    } else {
        echo "Sorry, there was an error uploading your file.";
    }

?>