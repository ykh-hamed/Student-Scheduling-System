<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <title>SRS .::Sign Up::.</title>
    <link rel="icon" href="../images/iconBUE.ico" type="image/x-icon">
    <link href="../includes/styles.css" type="text/css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="../includes/loadHF.js"></script>
    <script src="../includes/navigationScroll.js"></script>
    <script>
        var fullName;

        function start() {
            document.getElementById("signUpButton").addEventListener("click", Check);
        }

        function Check(evt) {
            if (!/^[a-zA-Z ]+$/.test(document.getElementById("fName").value)) {
                alert("Invalid username.")
                evt.preventDefault();
                return false;
            } else if (!/^[a-zA-Z ]+$/.test(document.getElementById("lName").value)) {
                alert("Invalid username.")
                evt.preventDefault();
                return false;
            } else if (!/^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(document.getElementById("email").value)) {
                alert("Invalid email.")
                evt.preventDefault();
                return false;
            } else if (!/^\d+$/.test(document.getElementById("mobile").value)) {
                alert("Invalid mobile.")
                evt.preventDefault();
                return false;
            } else if (document.getElementById("password").value != document.getElementById("password2").value) {
                alert("Passwords are not the same!")
                evt.preventDefault();
                return false;
            }


        }
        window.addEventListener("load", start, false);
    </script>
</head>

<body>
    <header id="headerLogIn">


    </header>
    <nav class="main-nav">
        <div id="navItems">
            <a href="http://www.bue.edu.eg/" class="navLink">BUE Website</a>
            <a href="http://learn.bue.edu.eg/" class="navLink">Elearning</a>
            <a href="http://lib.bue.edu.eg/" class="navLink">Library</a>
        </div>
    </nav>
    <div id="main">
        <form id="signUp" method="post" action="UserSignUp.php" enctype="multipart/form-data">
            <br>
            <br>
            <label>First Name:</label>
            <input id="fName" name="fName" class="usernamePass" type="text">
            <br>
            <br>
            <label>Last Name:</label>
            <input id="lName" name="lName" class="usernamePass" type="text">
            <br>
            <br>
            <label>Password: </label>
            <input id="password" name="password" class="usernamePass" type="password">
            <br>
            <br>
            <label>Pass Conf:</label>
            <input id="password2" class="usernamePass" type="password">
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
            <label> Photo : </label>
            <input type="file" name="image">
            <br>
            <br>
            <input id="signUpButton" type="submit" value="Sign Up">
        </form>
    </div>
    <div id="footerUser">

    </div>
</body>


</html>
<?php

function loadDB() {
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
}
loadDB();
// check if are are selected and filled
if (isset($_POST['facultySelect']) and isset($_POST['yearSelect']) and isset($_POST['fName']) and isset($_POST['lName']) and isset($_POST['password']))
{
    $file   =$_FILES['image'];
    if(isset($file)){
        $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    }
    else{
        
    }
    $fName=$_POST['fName'];
    $lName=$_POST['lName'];
    $password=$_POST['password'];
    $majorName=$_POST['facultySelect'];
    $year=$_POST['yearSelect'];
    $query="INSERT INTO `user`( `majorName`, `fName`, `lName`, `password`, `year`, `admin`,`image`) VALUES ('$majorName','$fName','$lName','$password','$year','0','$image')";
    $result= mysql_query($query);
    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }


}

?>