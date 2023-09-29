<?php include 'Header_Admin.php';
      include 'DBcontext.php';

      if (isset($_GET['ID'])) {
        $ID = $_GET['ID'];
        $sql = "SELECT * FROM product WHERE PID  = $ID "; // Replace with your actual table and column names
        $result = $conn->query($sql);
        $Data = $result->fetch_assoc();
      }
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <br>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">ข้อมูลชุดเช่า</h6>
            </div>

            <div class="card-body">
                <form class="row g-3" method="post" action="Controller/ProductDB.php" enctype="multipart/form-data">
                    <input type="text" name="PID" value="<?php echo $Data["PID"] ?>" hidden>
                    <div class="col-md-6">
                        <label  class="form-label">ชื่อ</label>
                        <input type="text" class="form-control" id="" name="ProductName" value="<?php  echo $Data["ProductName"] ?>">
                    </div>
                    <div class="col-md-6">
                        <label  class="form-label">ประเภท</label>
                        <input type="text" class="form-control" id="" name="ProductType" value="<?php  echo $Data["ProductType"] ?>">
                        </select>
                    </div>
                    <div class="col-12" style="padding-top: 10px;">
                        <label  class="form-label">รายละเอียด</label>
                        <input type="text" class="form-control" id="" name="ProductDetail" value="<?php  echo $Data["ProductDetail"] ?>">
                    </div>
                    <div class="col-md-3" style="padding-top: 10px;">
                        <label  class="form-label">ราคาปัจจุบัน/ราคาหลังลด(บาท)</label>
                        <input type="text" class="form-control" id="" name="ProductPrice" value="<?php  echo $Data["ProductPrice"] ?>">
                    </div>
                    <div class="col-md-3" style="padding-top: 10px;">
                        <label class="form-label">ราคาจากปกติ/ราคาก่อนลด(บาท)</label>
                        <input type="text" class="form-control" id="" name="Discount" value="<?php  echo $Data["Discount"] ?>">
                    </div>
                    <div class="col-md-1" style="padding-top: 10px;">
                        <label  class="form-label">จำนวน(ชุด)</label>
                        <input type="text" class="form-control" id="" name="ProductAmount" value="<?php  echo $Data["ProductAmount"] ?>">
                    </div>
                    <div class="col-md-2" style="padding-top: 10px;">
                        <label  class="form-label">ไซค์</label>
                        <input type="text" class="form-control" id="" name="Zise" value="<?php  echo $Data["Zise"] ?>">
                    </div>
                    <div class="col-md-2" style="padding-top: 10px;">
                        <label  class="form-label">สี</label>
                        <input type="text" class="form-control" id="" name="Color" value="<?php  echo $Data["Color"] ?>">
                    </div>
                    
                    <input type="text" name="Json" id="fileJson"  hidden>
                    <input type="submit" id="Delete" name="Delete" hidden>
                    <input type="submit" name="Edit" id="Edit" hidden>
                </form>

                <br>
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-6">
                            <h6 class="m-0 font-weight-bold text-primary">รูปชุดเช่า</h6>
                            </div>
                            <div class="col-6 row justify-content-end">
                                <button class="btn btn-success btn-icon-split" data-bs-toggle="modal" href="#exampleModalToggle">
                                    <span class="icon text-white-50">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <span class="text">เพิ่มรูป</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                            <table class="table table-hover"  width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ชื่อ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="FID" id="ImgLine_0" hidden > </tr>

                                <?php
                                    $Cout = 0;
                                    $sqlFile = "SELECT * FROM fliedoc WHERE PID = $ID";
                                    $resultFile = $conn->query($sqlFile);
                                    while ($file = $resultFile->fetch_assoc()) {
                                        $Cout++;
                                ?>
                                <tr class="FID" id="ImgLine_<?php echo $Cout?>" >
                                    <td style="width:100px;"> <img style="width:100px;" src="Photo/<?php echo $file["FileURL"];?>" class="rounded mx-auto d-block" > </td>
                                    <td><?php  echo $file["FlieName"] ?></td>
                                    <td class="text-center">
                                        <button type="button" onclick="DeleteItem(<?php echo $Cout ?>)" class="btn btn-danger btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text">ลบ</span>
                                        </button>
                                    </td>
                                    <td hidden>
                                        <input type="text" name="FID" id="FID_<?php echo $Cout ?>" value="<?php echo $file["FID"]?>">
                                        <input type="text" name="FileAction" id="FileAction_<?php echo $Cout ?>" value="<?php echo $file["FlieName"]; ?>" hidden>
                                        <input type="text"  id="File64_<?php echo $Cout ?>" value="" hidden >
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row justify-content-md-center">
                    <button type="submit" class="btn btn-primary" onclick="Update()">บันทึก</button>&nbsp;&nbsp;
                    <button class="btn btn-danger" onclick="Delete(<?php echo $ID ?>)">ลบ</button> &nbsp;&nbsp;
                    <button class="btn btn-secondary" onclick="Close()">ยกเลิก</button>
                </div>

            </div>

        </div>

    </div>
    <!-- /.container-fluid -->

    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">รูปชุดเช่า</h5>
                </div>
                <div class="modal-body">
                    <div class="col-12" style="padding-top: 10px;">
                        <input type="file" class="form-control"  id="UplodeImg" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="AddFile()">เพิ่ม</button>
                    <button class="btn btn-danger" id="CloseItem" data-bs-dismiss="modal" aria-label="Close" >ยกเลิก</button>

                </div>
                </div>
            </div>
        </div>
    </div>

    <script>

     var DataSet = [];


    function DeleteItem(e){
        Swal.fire({
                title: 'คุณแน่ใจใช่ไหม?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่, ลบเลย!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#ImgLine_" + e).remove();
                }
        })
    }

    async function AddFile(){
        const elements = document.getElementsByClassName("FID");
        let maxId = 0;

        for (let i = 0; i < elements.length; i++)
        {
            const id = parseInt(elements[i].id.split("_")[1]); // Assuming the IDs are in the format "item_1", "item_2", etc.
            if (!isNaN(id) && id > maxId) {
            maxId = id;
            }
        }

        maxId = maxId+1;

        var FileImg = document.getElementById("UplodeImg");
        var  file = FileImg.files[0];
        var DataPort = { ID : maxId }
        var TypeFile = file.type.split("/")[1];
        var GenName = generateFileName(TypeFile);

        await  $.ajax({
            type: "POST",
            url: "Component/_FromFileProduct.php",
            data: {ID : maxId},
            success: function(response) {
                document.getElementById("ImgLine_0").insertAdjacentHTML("afterend", response);
                $("#Tname_" + maxId).html(file.name);
                $("#FileAction_" + maxId).val(GenName);

                var file64 = document.getElementById("File64_" + maxId);
                $("#FID_" + maxId).val(0);

                toBase64(file).then((value) => {
                file64.value = value;
                })

                var fileLine = document.getElementById("inputfile_" + maxId);
                var output = document.getElementById('output_' + maxId);
                output.src = URL.createObjectURL(file);
                output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
                }

                FileImg.value = "";
            }
            });

        $("#CloseItem").click();

    }

    const toBase64 = file => new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = reject;
    });

   function Delete(e){
      $("#Delete").click();
    }

    function Close (){
       window.location.assign("HomeAdmin.php");
    }

    function Update(){

        $.each($("input[name='FileAction']:text"), function () {

            var FID = this.id.split("_")[1];
            var filename = $("#FileAction_" + FID).val();
            var File64 = $("#File64_" + FID).val();
            var FID = $("#FID_" + FID).val();

            DataSet.push({ 
                FileName : filename,
                File64 : File64,
                FID : FID
            });

        });

        $("#fileJson").val(JSON.stringify(DataSet));

      $("#Edit").click();
    }

   function generateFileName(e) {
       var timestamp = new Date().getTime();
       var randomSuffix = Math.floor(Math.random() * 1000);
       var extension = '.' + e; // Change this to the desired file extension

       return 'file_' + timestamp + '_' + randomSuffix + extension;
   }

    </script>

<?php include 'Foodter.php'; ?>
