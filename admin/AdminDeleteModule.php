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
            <a href="AdminScheduleView.php" class="navLink">View Schedules</a>
            <a href="AdminScheduleEdit.php" class="navLink">Edit Schedules</a>
            <a href="AdminAddModule.php" class="navLink">Add Modules</a>
            <a href="AdminDeleteModule.php" class="navLink">Delete Module</a>
        </div>
    </nav>
    <div id="main">
        <h1 style="text-align:center">Schedule Editor</h1>
        <form method="post" action="AdminDeleteModule.php">
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
if(!isset($_SESSION['id'])) {
    session_destroy();
     header("Location: ../common/Home.php");
     exit;
}
$connect=@mysql_connect('localhost','root','');
if (!$connect)
{
    die("database connection went kaboom" . mysql_error());

}
$mydb=mysql_select_db('schedule');
if(!$mydb)
{
    die("could not select database :" . mysql_error());
}
//check if module is selected and delete it
if (isset($_POST['moduleSelect']))
{
    $moduleName=$_POST['moduleSelect'];
    $query="DELETE FROM `module` WHERE `moduleName`='$moduleName'";
    $result= mysql_query($query);
}
// populate modules
$query="SELECT * FROM `module` ";
$result= mysql_query($query);
echo " <script type='text/javascript'> (document.getElementById(\"modulesDiv\")).innerHTML=\"<label> Module : </label><select name='moduleSelect'><option disabled selected value > -- select an option -- </option> ";

while ( $row = mysql_fetch_row( $result ) ){
    echo "<option value='$row[0]' id='$row[0]'>".$row[0]."</option>";

}
echo"</select><br><br>\" ;</script>";


?>