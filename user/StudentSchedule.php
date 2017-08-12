<?php
session_start();
if(!isset($_SESSION['id'])) {
    session_destroy();
    header("Location: ../common/index.php"); // redirects them to homepage
    exit; 
}
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Schedule</title>
        <link rel="icon" href="../images/iconBUE.ico" type="image/x-icon">
        <link href="../includes/styles.css" type="text/css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="../includes/navigationScroll.js"></script>
        <script src="../includes/loadHF.js"></script>
        <script src="../includes/getModuleInfo.js"></script>
        <script>
            $(document).ready(function () {
                $('#tablelol').load("loadSchedule.php");
            });
        </script>
        <div id="tablelol"></div>
    </head>

    <body>

        <header id="header"></header>
        <nav class="main-nav">
            <div id="navItems">
                <a href="http://www.bue.edu.eg/" class="navLink">BUE Website</a>
                <a href="http://learn.bue.edu.eg/" class="navLink">Elearning</a>
                <a href="http://lib.bue.edu.eg/" class="navLink">Library</a>
            </div>
        </nav>
        <div id="main">
            <h1 style="text-align:center">Schedule</h1>
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

        <div id="footerUser">

        </div>

    </body>


    </html>