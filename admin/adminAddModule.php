<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Module</title>
    <link rel="icon" href="../images/iconBUE.ico" type="image/x-icon">
    <link href="../includes/styles.css" type="text/css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="../includes/navigationScroll.js"></script>
    <script src="../includes/loadHF.js"></script>

</head>

<body>

    <header id="header"></header>
    <nav class="main-nav">
        <div id="navItems">
            <a href="adminScheduleView.php" class="navLink">View Schedules</a>
            <a href="adminScheduleEdit.php" class="navLink">Edit Schedules</a>
            <a href="adminAddModule.php" class="navLink">Add Modules</a>
            <a href="adminDeleteModule.php" class="navLink">Delete Modules</a>
        </div>
    </nav>
    <div id="main">
        <h1 style="text-align:center">Schedule Editor</h1>
        <form method="post" action="adminAddModule.php">
            <label>Module Name:</label>
            <input type="text" name="moduleName" required>
            <br>
            <br>
            <label>Doctor Name:</label>
            <input type="text" name="doctorName" required>
            <br>
            <br>
            <label>Faculty:</label>
            <select id="facultySelect" name="facultySelect">
                <option disabled selected value> -- select an option -- </option>
                <option value="Engineering" id="Engineering">Engineering</option>
                <option value="ICS" id="ICS">ICS</option>
                <option value="Pharmacy" id="Pharmacy">Pharmacy</option>
                <option value="Political Science" id="Political Science">Political Science</option>
            </select>
            <br>
            <br>
            <div id="yearsDiv">
                <label> Year : </label>
                <select id="yearSelect" name="yearSelect">
                    <option disabled selected value> -- select an option -- </option>
                    <option value="1" id="y1">year 1</option>
                    <option value="2" id="y2">year 2</option>
                    <option value="3" id="y3">year 3</option>
                    <option value="4" id="y4">year 4</option>
                </select>
            </div>
            <br>
            <br>

            <input type="submit" name="action" value="submit">
            <br>
            <br>


        </form>

    </div>
    <div id="footerAdmin">

    </div>
</body>

</html>
<?php
session_start();
if (!isset($_SESSION['id'])) {
    session_destroy();
    header("Location: ../index.php"); // redirects them to homepage
     exit; // for good measure
}
// check if all are selected and filled
if (isset($_POST['moduleName']) and isset($_POST['doctorName']) and isset($_POST['facultySelect']) and isset($_POST['yearSelect'])) {
    // load the database
    include('../common/DBconnection.php');
    // get inputs into variables
    $moduleName=strtolower($_POST['moduleName']);
    $doctorName=strtolower($_POST['doctorName']);
    $majorName=$_POST['facultySelect'];
    $year=$_POST['yearSelect'];
    $query="SELECT * FROM `module` WHERE `moduleName`='$moduleName'";
    $result= mysql_query($query);
    $check=mysql_num_rows($result);
    //check if module name already used
    if ($check==1) {
        echo "<script type='text/javascript'>alert('Module name already used');</script>";
    } else {
        //insert modules
        $query="INSERT INTO `module`(`moduleName`, `doctorName`,`year`, `majorName`) VALUES ('$moduleName','$doctorName','$year','$majorName')";
        $result= mysql_query($query);
    }
}

?>