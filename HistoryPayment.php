<?php include 'Header.php'; ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <br>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">ข้อมูลการชำระเงิน</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="TbProduct" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>วันที่ชำระเงิน</th>
                                <th>ช่วงเวลา</th>
                                <th>ชื่อ - นามสกุล</th>
                                <th>จำนวนเงิน</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $sql = "SELECT (SELECT SUM(Amount) FROM attemptdetail WHERE AID = T.AID) as TotalAmount , T.AID, T.AccountID, T.AttemptDate, T.AttemptTemp ,A.Prefix , A.Name, A.LastName FROM attempt T
                                    INNER JOIN account A ON T.AccountID = A.AccountID WHERE A.AccountID = $AccountCode";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                        ?>
                            <tr onclick="Product(<?php echo $row["AID"] ?>)" >
                                <td><?php echo $row["AttemptDate"]?></td>
                                <td><?php echo $row["AttemptTemp"]?></td>
                                <td><?php echo $row["Prefix"] ." ".  $row["Name"] . " " . $row["LastName"]?> </td>
                                <td><?php echo $row["TotalAmount"]?> ชุด</td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <script>

     let table = new DataTable('#TbProduct');

    function Product(e){
        window.location.assign("HistoryAttemptDetail.php?ID="+e+"")
    }

    </script>


<?php include 'Foodter.php'; ?>
