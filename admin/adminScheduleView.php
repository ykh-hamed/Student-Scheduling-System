<?php
//check if not loggedin
session_start();
if (!isset($_SESSION['id'])) {
    session_destroy();
    header("Location: ../index.php");
    exit;
}

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>View Schedule</title>
        <link rel="icon" href="../images/iconBUE.ico" type="image/x-icon">
        <link href="../includes/styles.css" type="text/css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="../includes/navigationScroll.js"></script>
        <script src="../includes/loadHF.js"></script>
        <script src="../includes/getModuleInfo.js"></script>
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
            <h1 style="text-align:center">Schedule Viewer</h1>
            <form method="post" action="adminScheduleView.php">
                <label>Faculty:</label>
                <select id="facultySelect" name="facultySelect">
                    <option disabled selected value> -- select an option -- </option>
                    <option value="Engineering">Engineering</option>
                    <option value="ICS">ICS</option>
                    <option value="Pharmacy">Pharmacy</option>
                    <option value="Political Science">Political Science</option>
                </select>
                <br>
                <br>
                <div id="yearsDiv">
                    <label> Year : </label>
                    <select id="yearSelect" name="yearSelect">
                        <option disabled selected value> -- select an option -- </option>
                        <option value="1">year1</option>
                        <option value="2">year2</option>
                        <option value="3">year3</option>
                        <option value="4">year4</option>
                    </select>
                </div>
                <input type="submit" value="Go">

                <br>
                <br>
                <br>
                <br>
                <br>
                <br>

            </form>
            <div id="scheduleTable">
                <table>
                    <tr>
                        <th>Time</th>
                        <th>Sunday</th>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thrusday</th>
                        <th>Saturday</th>
                    </tr>
                    <tr>
                        <th>
                            9:00 - 10:00
                        </th>
                        <td id="d1s1"> </td>
                        <td id="d2s1"> </td>
                        <td id="d3s1"> </td>
                        <td id="d4s1"> </td>
                        <td id="d5s1"> </td>
                        <td id="d6s1"> </td>
                    </tr>
                    <tr>
                        <th>
                            10:00 - 11:00
                        </th>
                        <td id="d1s2"> </td>
                        <td id="d2s2"> </td>
                        <td id="d3s2"> </td>
                        <td id="d4s2"> </td>
                        <td id="d5s2"> </td>
                        <td id="d6s2"> </td>
                    </tr>
                    <tr>
                        <th>
                            11:00 - 12:00
                        </th>
                        <td id="d1s3"> </td>
                        <td id="d2s3"> </td>
                        <td id="d3s3"> </td>
                        <td id="d4s3"> </td>
                        <td id="d5s3"> </td>
                        <td id="d6s3"> </td>
                    </tr>
                    <tr>
                        <th>
                            12:00 - 1:00
                        </th>
                        <td id="d1s4"> </td>
                        <td id="d2s4"> </td>
                        <td id="d3s4"> </td>
                        <td id="d4s4"> </td>
                        <td id="d5s4"> </td>
                        <td id="d6s4"> </td>
                    </tr>
                    <tr>
                        <th>
                            1:00 - 2:00
                        </th>
                        <td id="d1s5"> </td>
                        <td id="d2s5"> </td>
                        <td id="d3s5"> </td>
                        <td id="d4s5"> </td>
                        <td id="d5s5"> </td>
                        <td id="d6s5"> </td>
                    </tr>
                    <tr>
                        <th>
                            2:00 - 3:00
                        </th>
                        <td id="d1s6"> </td>
                        <td id="d2s6"> </td>
                        <td id="d3s6"> </td>
                        <td id="d4s6"> </td>
                        <td id="d5s6"> </td>
                        <td id="d6s6"> </td>
                    </tr>
                    <tr>
                        <th>
                            3:00 - 4:00
                        </th>
                        <td id="d1s7"> </td>
                        <td id="d2s7"> </td>
                        <td id="d3s7"> </td>
                        <td id="d4s7"> </td>
                        <td id="d5s7"> </td>
                        <td id="d6s7"> </td>
                    </tr>

                </table>
            </div>
            <div id="moduleInfo"></div>

        </div>
        <div id="footerAdmin">

        </div>


    </body>


    </html>
    <?php

// load the database
include('../common/DBconnection.php');
// check if both selected and load schedule
if (isset($_POST['facultySelect']) and isset($_POST['yearSelect'])) {
    $majorName=$_POST['facultySelect'];
    $year=$_POST['yearSelect'];

    $query="SELECT * FROM  module f Right JOIN (SELECT * FROM timetable fp ) 
     as fp ON (f.moduleName = fp.moduleName) WHERE `majorName`='$majorName' AND `year`='$year'";

    $result= mysql_query($query);
    echo "<script type='text/javascript'>";
    while ($row = mysql_fetch_row($result)) {
        for ($i = 4; $i <=  10; $i++) {
            $slot=$i-3;
            if ($row[$i+2]) {
                echo "(document.getElementById(\"d".$row[5]."s".$slot."\")).innerHTML='$row[0]<br><br>Dr.$row[1]';";
            }
        }
    }
    echo"</script>";
}
?>