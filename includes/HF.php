<div id="header">
    <a href='../index.php'>
        <img src="../images/logo.png" style="float: left; " alt="logo" width="240" height="160"></a>
    <div id="userStuff">
        <div id="userImage">
            <?php
            //set user pic
            // load the database
            include('../common/DBconnection.php');
            session_start();
            $id= $_SESSION['id'];
            $query="SELECT * FROM `user`WHERE id=$id";
            $result= mysql_query($query);
            $row = mysql_fetch_array($result) ;
            if($row[7]!="")
                echo '<img alt="User picture" width="155" height="150" src="data:image/jpeg;base64,'.base64_encode( $row[7] ).'"/>';
            else
                echo '<img alt="User picture" width="155" height="150" src="../images/nopic.jpg'.base64_encode( $row[7] ).'"/>';
            ?>

        </div>
        <!-- this is  just to make it like it works before implementing php it gives an error in the page validation-->
        <form method="post" action="../includes/logout.php">
            <input id="logOutBtn" type="submit" value="Log Out">
        </form>
        <!-- <input id="logOut" type="submit" value="log out">-->

    </div>

</div>
<div id="footerUser">
    <p style="float:right;  position: absolute; right: 0px; bottom:0px;">
        <small>Copyright &copy; 2016 British University in Egypt</small></p>
    <div style="float:left">
        <h4 style="padding-left:20px;">Site Map:</h4>
        <ul>
            <li> <a href="http://www.bue.edu.eg/" class="navLink">BUE Website</a></li>
            <li><a href="http://learn.bue.edu.eg/" class="navLink">Elearning</a></li>
            <li><a href="http://lib.bue.edu.eg/" class="navLink">Library</a></li>
            <li>SRS</li>
            <ul>
                <li> <a href="../user/studentSchedule.php" class="navLink">Schedule</a></li>
            </ul>

        </ul>
    </div>
</div>
<div id="footerAdmin">
    <p style="float:right;  position: absolute; right: 0px; bottom:0px;">
        <small>Copyright &copy; 2016 British University in Egypt</small></p>
    <div style="float:left">
        <h4 style="padding-left:20px;">Site Map:</h4>
        <ul>
            <li> <a href="http://www.bue.edu.eg/" class="navLink">BUE Website</a></li>
            <li><a href="http://learn.bue.edu.eg/" class="navLink">Elearning</a></li>
            <li><a href="http://lib.bue.edu.eg/" class="navLink">Library</a></li>
            <li>SRS</li>
            <ul>
                <li> <a href="../admin/adminScheduleEdit.php" class="navLink">Schedule Edit</a></li>
                <li> <a href="../admin/adminScheduleView.php" classa="navLink">Schedule View</a></li>
                <li> <a href="../admin/adminAddModule.php" class="navLink">Add Modules</a></li>
                <li> <a href="../admin/adminDeleteModule.php" class="navLink">Delete Modules</a></li>
            </ul>

        </ul>
    </div>
</div>

<div id="headerLogIn">
    <a href="../index.php"><img src="../images/logo.png" style="display: block;
        margin: 0 auto; " alt="logo" width="300" height="210"></a>

</div>