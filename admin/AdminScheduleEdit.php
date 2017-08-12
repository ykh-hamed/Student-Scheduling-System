<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Schedule</title>
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
        <form method="post" action="adminScheduleEdit.php">
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

            <div id="modulesDiv"></div>
            <div id="Day">

            </div>
            <br>
            <br>

            <div id="TimeSlotsDiv">
            </div>
            <br>
            <br>
            <input type="submit" name="action" value="load">
            <br>
            <br>
            <div id="submitBtn">

            </div>

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
// check if both are selected
if (isset($_POST['facultySelect']) and isset($_POST['yearSelect'])) {
    $moduleName="";
    $day="";
    $majorName="";
    $year="";
    if (isset($_POST['moduleSelect'])) {
        $moduleName=$_POST['moduleSelect'];
    }
    $majorName=$_POST['facultySelect'];
    $year=$_POST['yearSelect'];

    // display days
    echo"<script>(document.getElementById(\"Day\")).innerHTML=\" <label> Day : </label><select id='daySelect' name='daySelect'><option disabled selected value> -- select an option -- </option><option value='1' id='d1'>Sunday</option><option value='2' id='d2'>Monday</option><option value='3' id='d3'>Tuesday</option><option value='4' id='d4'>Wednesday</option><option value='5' id='d5'>Thursday</option><option value='6' id='d6'>Saturday</option></select>\"</script> ";

    if (isset($_POST['daySelect'])) {
        $day=$_POST['daySelect'];
    }
    // when posting elements become unselected again
    // so this is to reselect them
    echo "<script>$(".$majorName.").attr('selected', true);$(y".$year.").attr('selected', true);$(d".$day.").attr('selected', true);</script>";


    // display modules of specific major and year
    $query="SELECT * FROM  `module` WHERE `majorName`='$majorName' AND `year`='$year'";
    $result= mysql_query($query) or die(mysql_error());
    echo " <script type='text/javascript'> (document.getElementById(\"modulesDiv\")).innerHTML=\"<label> Module : </label><select name='moduleSelect'><option disabled selected value > -- select an option -- </option> ";

    // populating modules menu
    while ($row = mysql_fetch_row($result)) {
        if ($row[0]==$moduleName) {
            echo "<option value='$row[0]' selected id='$row[0]'>".$row[0]."</option>";
        } else {
            echo "<option value='$row[0]' id='$row[1]'>".$row[0]."</option>";
        }
    }

    echo"</select><br><br>\" ;</script>";

    // if all is selected load the timeslots
    if (isset($_POST['facultySelect']) and isset($_POST['yearSelect'])and isset($_POST['daySelect']) and isset($_POST['moduleSelect'])) {
        // if the user submits changes
        if (isset($_POST['action']) && $_POST['action'] == 'submitChanges') {
            $arr2 = array();
            for ($i=1;$i<=7;$i++) {
                if (isset($_POST['s'.$i])) {
                    array_push($arr2, "1");
                } else {
                    array_push($arr2, "0");
                }
            }
            //check if slot not taken
            $checkslot=true;
            for ($i=1;$i<=7;$i++) {
                if ($arr2[$i-1]=="1") {
                    $curslot="s".$i;
                    $query="SELECT * FROM  module f Right JOIN (SELECT * FROM timetable fp ) as fp ON (f.moduleName = fp.moduleName)  WHERE`d`='$day' AND `$curslot`='1' AND f.moduleName!='$moduleName' AND `majorName`='$majorName' AND `year`='$year' ";
                    $result= mysql_query($query);
                    if (!$result) {
                        die('Invalid query: ' . mysql_error());
                    }
                    $check=mysql_num_rows($result);
                    if ($check>0) {
                        $checkslot=false;
                    }
                }
            }
            if ($checkslot) {
                $query="SELECT * FROM `timetable` WHERE`d`='$day' AND `moduleName`='$moduleName' ";
                $result= mysql_query($query);
                $check=mysql_num_rows($result);
                //updating the timetable table
                if ($check==1) {
                    $query="UPDATE `timetable` SET `s1`='$arr2[0]',`s2`='$arr2[1]',`s3`='$arr2[2]',`s4`='$arr2[3]',`s5`='$arr2[4]',`s6`='$arr2[5]',`s7`='$arr2[6]' WHERE `moduleName`='$moduleName' AND `d`='$day'";
                    $result= mysql_query($query);
                } else {
                    $query="INSERT INTO `timetable`(`moduleName`, `d`, `s1`, `s2`, `s3`, `s4`, `s5`, `s6`, `s7`) VALUES ('$moduleName','$day','$arr2[0]','$arr2[1]','$arr2[2]','$arr2[3]','$arr2[4]','$arr2[5]','$arr2[6]')";
                    $result= mysql_query($query);
                    if (!$result) {
                        die('Invalid query: ' . mysql_error());
                    }
                }
            } else {
                echo "<script type='text/javascript'>alert('One of the selected slots already occupied');</script>";
            }
        }
        $query="SELECT * FROM `timetable` WHERE  `d`='$day' AND `moduleName`='$moduleName' ";
        $result= mysql_query($query);
        $row = mysql_fetch_row($result);
        $arr=array();
        for ($i=2;$i<=8;$i++) {
            if ($row[$i]=="1") {
                array_push($arr, "checked");
            } else {
                array_push($arr, " ");
            }
        }
        //loading timeslots
        echo"<script>(document.getElementById(\"TimeSlotsDiv\")).innerHTML=\"<label>TimeSlots:</label><br><br><input type='checkbox' name='s1' value='1' $arr[0]> 09:00    -  10:00<br><input type='checkbox' name='s2' value='2' $arr[1]> 10:00   -    11:00<br><input type='checkbox' name='s3' value='3' $arr[2]> 11:00   -   12:00<br><input type='checkbox' name='s4' value='4' $arr[3]> 12:00   -   13:00<br><input type='checkbox' name='s5' value='5' $arr[4]> 13:00    -   14:00 <br><input type='checkbox' name='s6' value='6' $arr[5]> 14:00     -   15:00<br><input type='checkbox' name='s7' value='7' $arr[6]> 15:00  -  16:00<br>\"";

        echo"</script>";

        echo"<script>(document.getElementById('submitBtn')).innerHTML = \"<input type='submit' name='action' value='submitChanges'>\"</script>";
    }
}
?>