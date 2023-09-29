<?php
include '../DBcontext.php';

if(isset($_POST['ID'])){
  $ID = $_POST['ID'];
  $Number = $_POST['Number'];

  $sql = "SELECT * FROM product WHERE PID  = $ID "; // Replace with your actual table and column names
  $result = $conn->query($sql);
  $Data = $result->fetch_assoc();

}

 ?>

  <tr onclick="Order(<?php  echo $ID?>)" >
      <td style="width:100px;"> <img style="width:100px;" src="img/line_33846880930691197844396.jpeg" class="rounded mx-auto d-block" > </td>
      <td><?php  echo $Data["ProductName"] ?> </td>
      <td><?php  echo $Data["Zise"] ?></td>
      <td><?php  echo $Number ?></td>
      <input type="text" hidden class="Amount" name="PIDLine" id="PID_<?php  echo $ID?>" value="<?php  echo $ID?>">
      <input type="text" hidden class="Amount" name="NumberLine" id="NumberLine_<?php  echo $ID?>" value="<?php  echo $Number?>">
  </tr>
