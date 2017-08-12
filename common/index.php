<?php
session_start();
// load the database
include('DBconnection.php');
//check if loggedin and redirect
if(isset($_SESSION['id'])) {
    $id=$_SESSION['id'];
    $query="SELECT * FROM `user` WHERE  id='$id'";
    $result= mysql_query($query);
    $row = mysql_fetch_array($result);
    if(!$row[6])
        header('Location: ../user/studentSchedule.php');
    else if($row[6])
        header('Location: ../admin/adminScheduleView.php');
    exit; 
}
?>
    <!DOCTYPE html>

    <html lang="en">


    <head>
        <meta charset="UTF-8">
        <title>SRS .::Log in::.</title>
        <link rel="icon" href="../images/iconBUE.ico" type="image/x-icon">
        <script src="../includes/logIn.js"></script>
        <link href="../includes/styles.css" type="text/css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="../includes/loadHF.js"></script>
        <script src="../includes/navigationScroll.js"></script>

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
            <form id="login" method="post" action="index.php">
                <br>
                <br>
                <br>
                <input id="userName" name="userName" class="usernamePass" type="text" placeholder="Username" autofocus required>
                <br>
                <br>
                <input id="password" name="password" class="usernamePass" type="password" placeholder="Password" required>
                <br>
                <br>
                <a href="../user/userSignUp.php">Sign up?</a>
                <br>

                <br>

                <input id="loginButton" type="submit" value="Log in">
            </form>
        </div>
        <div id="footerUser">

        </div>
    </body>


    </html>
    <?php



// check if both username and password posted
if (isset($_POST['userName']) and isset($_POST['password']))
{
    //slice fname and id to check with the id in the server so user
    // can login with either fname+id or just id
    $id='';
    $fname='';
    $username=$_POST['userName'];
    $strlen = strlen( $username );
    for ($i = 0; $i <=  $strlen; $i++) {
        $char = substr( $username, $i, 1 );
        if( is_numeric( $char ) ) { 
            $fname=substr( $username, 0, $i );
            $id=substr( $username, $i, $strlen-$i );
            break; 
        }
    } 
    
    $password=$_POST['password'];
    // search to see if user exists
    $query="SELECT * FROM `user` WHERE  id='$id' and password='$password'";
    $result= mysql_query($query);
    $check=mysql_num_rows($result);
    if ($check==1){
        $_SESSION['id']=$id;
        //check if admin or not
        $row = mysql_fetch_array($result);
        if(!$row[6])
            header('Location: ../user/studentSchedule.php');
        else if($row[6])
            header('Location: ../admin/adminScheduleView.php');
    }
    // if doesnt exists reload with message 
    else echo "<script type='text/javascript'>alert('invalid credentials');</script>";


}
?>