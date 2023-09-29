<?php

  if(isset($_POST['ID'])){
    $ID = $_POST['ID'];
  }

?>

<tr class="FID" id="ImgLine_<?php echo $ID ?>">
    <td style="width:100px;">
      <img style="width:100px;" id="output_<?php echo $ID ?>" class="rounded mx-auto d-block" src="">
      <input type="text" name="FileAction" id="FileAction_<?php echo $ID ?>" hidden>
      <input type="text" name="File64" id="File64_<?php echo $ID?>"hidden >
      <input type="text" name="FID" id="FID_<?php echo $ID?>" hidden>
    </td>
    <td> <label id="Tname_<?php echo $ID ?>" ></label> </td>
    <td class="text-center">
      <button type="button" onclick="DeleteItem(<?php echo $ID ?>)" class="btn btn-danger btn-icon-split">
        <span class="icon text-white-50">
          <i class="fas fa-trash"></i>
        </span>
        <span class="text">Delete</span>
      </button>
    </td>
</tr>
