<?php include 'Header_Admin.php';
      include 'DBcontext.php';

      if(isset($_POST['Submit'])){

        $ProductName = $_POST['ProductName'];
        $ProductType = $_POST['ProductType'];
        $ProductDetail = $_POST['ProductDetail'];
        $ProductAmount = $_POST['ProductAmount'];
        $Discount = $_POST['Discount'];
        $ProductPrice = $_POST['ProductPrice'];
        $Zise = $_POST['Zise'];
        $Color = $_POST['Color'];
        $jsonData = $_POST['Json'];

        $arr = json_decode($jsonData, true);


        $Sql = "INSERT INTO Product(ProductName, ProductDetail, Zise,Color, ProductAmount, FID, ProductPrice, Discount, ProductType)
                VALUES ('$ProductName','$ProductDetail','$Zise','$Color','$ProductAmount',null,'$ProductPrice','$Discount','$ProductType') ";

        if ($conn->query($Sql) === TRUE) {
            $last_id = $conn->insert_id;

            foreach($arr as $item) { //foreach element in $arr

                $File64 = $item['File64'];
                $FileNameDisplay = $item['FileNameDisplay'];

                $uploadpath   = 'Photo/';
                $parts        = explode(";base64,", $File64);
                $imageparts   = explode("image/", @$parts[0]);
                $imagetype    = $imageparts[1];
                $imagebase64  = base64_decode($parts[1]);
                $filename     = uniqid() . '.' . $imagetype;
                $file         = $uploadpath . $filename;

                $sqlfile = "INSERT INTO fliedoc( PID, FlieName, FileURL) VALUES ('$last_id','$FileNameDisplay','$filename')";
                $conn->query($sqlfile);

                file_put_contents($file, $imagebase64);
            }

            echo "<script>alert('ทำรายการสำเร็จ!')</script>";
            echo "<script>window.location.href='HomeAdmin.php'</script>";
        } else {
            echo "<script>alert('"+$conn->error+"')</script>";
            echo "<script>window.location.href='HomeAdmin.php'</script>";
        }

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
                    <form class="row g-3" method="post">
                        <div class="col-md-6">
                            <label  class="form-label">ชื่อ</label>
                            <input type="text" class="form-control" name="ProductName" id="">
                        </div>
                        <div class="col-md-6">
                            <label  class="form-label">ประเภท</label>
                            <input type="text" class="form-control" name="ProductType" >
                        </div>
                        <div class="col-12" style="padding-top: 10px;">
                            <label  class="form-label">รายละเอียด</label>
                            <input type="text" class="form-control" name="ProductDetail" id="" >
                        </div>
                        <div class="col-md-3" style="padding-top: 10px;">
                            <label  class="form-label">ราคาปัจจุบัน/ราคาหลังลด(บาท)</label>
                            <input type="text" class="form-control" name="ProductPrice" id="">
                        </div>
                        <div class="col-md-3" style="padding-top: 10px;">
                            <label class="form-label">ราคาจากปกติ/ราคาก่อนลด(บาท)</label>
                            <input type="text" class="form-control" name="Discount" id="">
                        </div>
                        <div class="col-md-1" style="padding-top: 10px;">
                            <label  class="form-label">จำนวน</label>
                            <input type="number" class="form-control" name="ProductAmount" id="">
                        </div>
                        <div class="col-md-3" style="padding-top: 10px;">
                            <label  class="form-label">ไซค์</label>
                            <input type="text" class="form-control" name="Zise" id="">
                        </div>
                        <div class="col-md-2" style="padding-top: 10px;">
                            <label  class="form-label">สี</label>
                            <input type="text" class="form-control" name="Color" id="">
                        </div>

                        <div class="FromFile" id="FromFile_0" hidden>
                        </div>

                        <input type="text" name="Json" id="fileJson" hidden >
                        <input type="submit" name="Submit" id="Submit" hidden>

                    </form>

                    <br>
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
                                    <!-- <tr>
                                        <th></th>
                                        <th>ชื่อ</th>
                                        <th></th>
                                    </tr> -->
                                </thead>
                                <tbody id="LID">
                                    <tr onclick="" class="FID" id="ImgLine_0" hidden >
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="row justify-content-md-center">
                         <button type="submit" class="btn btn-primary" onclick="Submit()">บันทึก</button>
                    </div>

                </div>

            </div>

        </div>
        <!-- /.container-fluid -->

      <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" >รูปสินค้า</h5>
                  </div>
                  <div class="modal-body">
                      <div class="col-12" style="padding-top: 10px;">
                          <input type="file" class="form-control" id="UplodeImg" >
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button class="btn btn-primary" onclick="AddFile()" >เพิ่ม</button>
                      <button class="btn btn-danger" id="CloseItem" data-bs-dismiss="modal" aria-label="Close" >ยกเลิก</button>
                  </div>
                  </div>
             </div>
          </div>
      </div>

    <script>

    var JsonData = [];

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

               var blob = file.slice(0, file.size, file.type);
               var newFile = new File([blob], GenName, {type: file.type});

              var fileLine = document.getElementById("inputfile_" + maxId);
              var file64 = document.getElementById("File64_" + maxId);

              toBase64(newFile).then((value) => {
                file64.value = value;
              })

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

    function DeleteItem(e){
      Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              console.log("De", e);
              document.getElementById("ImgLine_"+e).remove();
            }
          })
    }

    var DataSet = [];

  async  function Submit(){

      $.each($("input[name='FileAction']:text"), function () {

        var FID = this.id.split("_")[1];
        var filename = $("#FileAction_" + FID).val();
        var File64 = $("#File64_" + FID).val();

        DataSet.push({ FileNameDisplay : this.value ,
                       FileName : filename,
                       File64 : File64
         });


      });

      console.log('json', DataSet);

      $("#fileJson").val(JSON.stringify(DataSet));
      $("#Submit").click();
    }

    function generateFileName(e) {
        var timestamp = new Date().getTime();
        var randomSuffix = Math.floor(Math.random() * 1000);
        var extension = '.' + e; // Change this to the desired file extension

        return 'file_' + timestamp + '_' + randomSuffix + extension;
    }

    </script>

<?php include 'Foodter.php'; ?>
