<?php
include('configall.php');
if (isset($_POST["add"])) {
    $absence = $_POST["absence"];
    $loan_cut = 0;
    $pfund_cut = 0;
    $overtime = $_POST["overtime"];
    $sbonus = $_POST["Sbonus"];
    $medi_allow = 0;
    $house_allow = 0;
    $accno = $_POST['accno'];
    //$month = $_POST["month"];
    //$year = $_POST["year"];
    $date = $_POST["date"];
    $empid = $_POST["id"];
    $obonus = $_POST["Obonus"];
    $total = 0;

    $sql = "SELECT * FROM EMP INNER JOIN JOB WHERE EMP.JobTitle=JOB.Job_Title and EMP.EmpId='$empid';";

    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($result);
    $name = $row['EmpName'];
    $job = $row['JobTitle'];
    $medi_allow = $row['basic_salary'] * 0.03;
    $house_allow = $row['basic_salary'] * 0.08;
    $loan_cut = $row['loan'] * 0.05;
    $up_loan = $row['loan'] - $loan_cut;
    $pfund_cut = $row['basic_salary'] * 0.025;
    $gain = $overtime * 300 + $sbonus + $obonus + $row['basic_salary'] + $medi_allow + $house_allow;
    $cut = $loan_cut + $absence * 200 + $pfund_cut;
    $total = $gain - $cut;
    $up_fund = $row['pf'] + $pfund_cut;
    

    $sql3 = "SELECT MAX(PayNo) AS payid FROM EMP_SAL;";
    $result3 = mysqli_query($connection, $sql3);
    $row3 = mysqli_fetch_array($result3);
    $payid = $row3['payid'] + 1;

    $sql2 = "INSERT INTO EMP_SAL (PayNo,EmpId,EmpName,Absense,Overtime,Date,MedicAllow,HouseAllow,SBonus,OBouns,AccNo,PF,Loan,TotalSalary) VALUES ('$payid', '$empid','$name', '$absence', '$overtime','$date','$medi_allow', '$house_allow','$sbonus', '$obonus','$accno','$loan_cut', '$pfund_cut','$total');";

    $sql_uploan = "UPDATE EMP SET loan = '$up_loan',pf = '$up_fund' WHERE EMP.EmpId = $empid;";


    $done = mysqli_query($connection, $sql2);
    
    $update = mysqli_query($connection, $sql_uploan);
    if ($done) {
        echo 'Successfully inserted payment data';
        header('Location: employee.php');
    } else {
        echo 'Failed to insert payment data';
    }
}
