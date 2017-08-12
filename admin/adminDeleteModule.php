<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Delete Module</title>
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
        <form method="post" action="adminDeleteModule.php">
            <br>
            <br>
            <div id="modulesDiv"></div>

            <br>
            <br>
            <input type="submit" name="action" value="Delete">
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
    header("Location: ../common/index.php");
    exit;
}
// load the database
include('../common/DBconnection.php');
//check if module is selected and delete it
if (isset($_POST['moduleSelect'])) {
    $moduleName=$_POST['moduleSelect'];
    $query="DELETE FROM `module` WHERE `moduleName`='$moduleName'";
    $result= mysql_query($query);
}
// populate modules
    $query="SELECT * FROM `module` ";
$result= mysql_query($query);
echo " <script type='text/javascript'> (document.getElementById(\"modulesDiv\")).innerHTML=\"<label> Module : </label><select name='moduleSelect'><option disabled selected value > -- select an option -- </option> ";

while ($row = mysql_fetch_row($result)) {
    echo "<option value='$row[0]' id='$row[0]'>".$row[0]."</option>";
}
echo "</select><br><br>\" ;</script>";
?>