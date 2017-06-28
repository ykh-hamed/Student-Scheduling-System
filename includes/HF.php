<div id="header">
    <a href='../common/Home.php'>
        <img src="../images/logo.png" style="float: left; " alt="logo" width="240" height="160"></a>
    <div id="userStuff">
        <div id="userImage">
            <?php
            //set user pic
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
                <li> <a href="../user/StudentSchedule.php" class="navLink">Schedule</a></li>
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
                <li> <a href="../admin/AdminScheduleEdit.php" class="navLink">Schedule Edit</a></li>
                <li> <a href="../admin/AdminScheduleView.php" classa="navLink">Schedule View</a></li>
                <li> <a href="../admin/AdminAddModule.php" class="navLink">Add Modules</a></li>
                <li> <a href="../admin/AdminDeleteModule.php" class="navLink">Delete Modules</a></li>
            </ul>

        </ul>
    </div>
</div>

<div id="headerLogIn">
    <a href="../common/Home.php"><img src="../images/logo.png" style="display: block;
        margin: 0 auto; " alt="logo" width="300" height="210"></a>

</div>