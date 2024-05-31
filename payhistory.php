<?php
include('configall.php');
$id = $_POST['id'];
if ($id) {
    $sql = "SELECT EMP_SAL.Date,EMP_SAL.PayNo,EMP_SAL.EmpId,EMP.EmpName,EMP.AccNo,EMP_SAL.TotalSalary FROM EMP INNER JOIN EMP_SAL WHERE EMP.EmpId=EMP_SAL.EmpId AND EMP.EmpId=$id;";
    $result = mysqli_query($connection, $sql);
}
?>
<!DOCTYPE html>
<html>
<title>payment history</title>

<body>
    <div class="w3-container">
        <h4>Employee Data</h4>
        <table>
            <tr>
                <th>Payment no</th>
                <th>Year</th>
                <th>month</th>
                <th>Bank account no</th>
                <th>Total salary</th>
                <?php while ($row = mysqli_fetch_array($result)) { ?>
            <tr>
                <td><?php echo $row['pay_no']; ?></td>
                <td><?php echo $row['year']; ?></td>
                <td><?php echo $row['month']; ?></td>
                <td><?php echo $row['bank_accno']; ?></td>
                <td><?php echo $row['total_pay']; ?></td>
            </tr> <?php } ?>
        </table>
    </div>
</body>

</html>